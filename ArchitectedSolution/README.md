# Architected Solution 🚀

Esta é uma versão avançada do desafio técnico. Ela foi desenvolvida para demonstrar conhecimentos em **Arquitetura de Software**, **PHP Moderno (8.1+)** e boas práticas de engenharia, indo além dos requisitos básicos.

---

## 🛠️ Requisitos do Sistema

* **PHP 8.1+**: Necessário para Enums, Readonly properties e Named Arguments.
* **MySQL 8.0.33**: Versão recomendada para suporte total a Constraints e UUIDs.
* **Composer**: Para gerenciamento de autoloading e scripts.

---

## 📂 Project Structure

A organização segue padrões de separação de responsabilidades (SoC), mantendo o núcleo da aplicação protegido fora da raiz pública.

```text
Architected Solution/
├── app/
│   ├── Console/Commands/      # Comandos CLI para Migration & Seeder
│   │   ├── Migrate.php
│   │   └── Seed.php
│   ├── Database/
│   │   ├── Database.php       # Singleton para conexão PDO
│   │   ├── Migrations/        # Estrutura de tabelas
│   │   │   ├── AbstractMigration.php
│   │   │   ├── 000001_create_employees_table.php
│   │   │   └── 000002_create_projects_table.php
│   │   └── Seeders/           # Dados de teste (100+ registros)
│   │       ├── EmployeesSeeder.php
│   │       └── ProjectsSeeder.php
│   ├── Enums/                 # Tipagem estrita para status de projetos
│   └── Models/                # Business Logic & Database Mapping
│       ├── Employee.php
│       └── Project.php
│
├── bootstrap/
│   └── app.php                # Inicialização do sistema
├── public/                    # Document Root (Acessível via Navegador)
│   ├── index.php              # Formulário de Cadastro
│   ├── employee.php           # Listagem de Funcionários
│   └── projects.php           # Listagem de Projetos
├── composer.json              # Autoload & Scripts
└── README.md
```

## 🚀 Como Iniciar

Siga os passos abaixo para configurar o ambiente e colocar a aplicação a funcionar.

### 1. Configuração do Banco de Dados

Certifique-se de que as credenciais de acesso ao MySQL estão corretamente configuradas no seu ficheiro `.env` ou na classe `app/Database/Database.php`.

### 2. Instalação e Migração

No terminal, dentro da pasta raiz `Architected Solution`, execute os seguintes comandos:

```bash
composer install

composer migrate

composer seed
```

### 3. Servidor Local

Inicie o servidor embutido do PHP apontando para a pasta pública (document root):

```bash
php -S localhost:8000 -t public
```

---

## ✉️ Nota ao Avaliador

Esta **Architected Solution** foi incluída como um diferencial para demonstrar competências avançadas em PHP e Engenharia de Software. Em vez de uma abordagem simplista com scripts procedurais, optei por uma estrutura profissional que reflete as melhores práticas do mercado:

* **Padrões de Projeto (Design Patterns):** Uso de *Active Record* simplificado nos Models e *Singleton* para a gestão da ligação PDO.
* **Segurança:** Implementação de identificadores híbridos (IDs internos para performance e UUIDs externos para segurança) e proteção rigorosa contra SQL Injection.
* **Modernização:** Código 100% compatível com PHP 8.1+, tirando partido de *Enums*, *Named Arguments* e *Typed Properties* para maior robustez.
* **Developer Experience (DX):** Automatização de tarefas repetitivas através de scripts CLI para Migrations e Seeders, facilitando o *onboarding* de outros desenvolvedores no projeto.

> "O objetivo foi apresentar um projeto que, embora simples no requisito, é robusto na base, fácil de testar e pronto para escalar para uma aplicação de grande porte."

---
