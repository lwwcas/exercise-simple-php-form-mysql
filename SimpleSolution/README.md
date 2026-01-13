# 🚀 Getting Started: PHP & MySQL Project

Este guia fornece as instruções rápidas para configurar o ambiente de desenvolvimento e colocar a aplicação em funcionamento.

---

### 🛠️ Requisitos do Sistema (Requirements)

Para garantir que todas as funcionalidades (como UUIDs e Heredoc SQL) funcionem corretamente, seu ambiente deve atender aos seguintes requisitos:

* **PHP 8.0+**: Utilizado para propriedades tipadas e sintaxe moderna.
* **MySQL 8.0.33**: Versão recomendada para compatibilidade total com os scripts de banco de dados.
* **Extensão PDO_MYSQL**: Deve estar habilitada no seu `php.ini` para permitir a conexão.

---

### 🗄️ Inicialização da Base de Dados (Database Setup)

**Atenção:** Antes de rodar a aplicação, você deve garantir que o schema e os dados de teste (seeds) foram importados corretamente.

Consulte o guia detalhado de banco de dados aqui:
📄 `/database/README.md`

**Passos básicos via MySQL/DBeaver:**

1. Execute as **Migrations** (Criação de tabelas).
2. Execute as **Seeds** (População dos 100 registros).

---

### 🚀 Como Iniciar o Servidor (Localhost)

O projeto utiliza o servidor embutido do PHP para facilitar o desenvolvimento. No seu terminal, navegue até a raiz do projeto e execute:

```bash
php -S localhost:8000 -t public
```
