# 🏢 Company Database Project (MySQL 8.0.33)

Este repositório contém os scripts de banco de dados para o sistema de gestão de funcionários e projetos. A estrutura foi desenhada seguindo as melhores práticas de separação entre **Schema (Migrations)** e **Data (Seeds)**.

---

## 🛠 Tech Stack & Versioning

* **Database Engine:** MySQL 8.0.33 (Community Server)
* **Default Port:** `3306`
* **Storage Engine:** `InnoDB` (Suporte a transações e chaves estrangeiras)
* **Charset:** `utf8mb4` (Suporte completo a caracteres especiais e emojis)
* **Collation:** `utf8mb4_unicode_ci` (Ordenação precisa para múltiplos idiomas)

### Por que a versão 8.0.33?

A versão 8.0 do MySQL introduziu melhorias críticas:

1. **Performance:** Otimização em índices e leituras em alta concorrência.
2. **Instant DDL:** Permite alterações de estrutura (como adicionar colunas) de forma quase instantânea.
3. **Segurança:** Novo sistema de autenticação `caching_sha2_password` (padrão nesta versão).

---

## 📂 Project Structure

O projeto está dividido para facilitar a manutenção e o deploy em diferentes ambientes (Desenvolvimento vs Produção):

* `01_migration_initial_schema.sql`: Define a estrutura do banco (Tabelas, Constraints e Índices).
* `02_seed_test_data.sql`: Popula o banco com 100 registros de funcionários e 100 de projetos para testes.

---

## 🚀 Setup Instructions (Step-by-Step)

### 1. Database Connection

Certifique-se de que seu serviço MySQL está rodando na porta **3306**. No **DBeaver**:

* **Host:** `localhost` (ou o IP do seu servidor).
* **Port:** `3306`.
* **Driver:** MySQL 8+.

### 2. Execution Order (Crucial)

Para evitar erros de integridade referencial, execute os ficheiros na seguinte ordem:

1. **Run Migration:** Execute o arquivo de Migration primeiro.
    * *Ação:* Cria o banco `company_db` e as tabelas `employees` e `projects`.
    * *Nota:* A tabela `projects` possui uma **Foreign Key** para `employees`.
2. **Run Seeds:** Execute o arquivo de Seed.
    * *Ação:* Insere os 100 registros de teste.

---

## 🔍 Database Schema Highlights

### Key Constraints Used

* **UUID (Universally Unique Identifier):** Usamos `CHAR(36)` para identificadores únicos, garantindo que os IDs de negócio não sejam sequenciais ou previsíveis.
* **ON DELETE CASCADE:** Implementado na relação Funcionário ↔ Projeto. Se um funcionário for deletado, todos os seus projetos vinculados serão removidos automaticamente, mantendo a limpeza dos dados.
* **Unsigned Integers:** Campos de ID e Idade utilizam `UNSIGNED`, o que dobra a capacidade de armazenamento positivo e evita valores negativos incoerentes.

---

## 💡 Quick Test Queries

Após a instalação, valide os dados com as queries abaixo:

```sql
-- 1. Verificar se os 100 funcionários foram criados
SELECT COUNT(*) FROM employees;

-- 2. Relatório de total investido em projetos por cargo
SELECT
    e.job,
    COUNT(p.id) AS total_projects,
    SUM(p.value) AS total_investment
FROM employees e
JOIN projects p ON e.id = p.employee_id
GROUP BY e.job
ORDER BY total_investment DESC;
