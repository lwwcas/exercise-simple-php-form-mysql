# PHP Challenge

Este repositório contém a resolução do desafio técnico, organizada em duas abordagens distintas para demonstrar diferentes níveis de implementação.

---

## 📂 Project Structure

### 1. [Simple Solution](./SimpleSolution)

Esta pasta contém a implementação focada estritamente nos requisitos solicitados no exercício. É uma solução direta, funcional e minimalista.

### 2. [Architected Solution](./ArchitectedSolution)

Esta versão é um **plus** que decidi incluir para demonstrar como eu estruturaria este desafio caso ele fosse o ponto de partida para um projeto real e escalável.

Embora ultrapasse o escopo inicial, achei importante demonstrar padrões que utilizo no meu dia a dia:

* **Architecture:** Separação clara entre lógica de negócio (`src/`) e ponto de entrada da aplicação (`public/`).
* **OOP (Object-Oriented Programming):** Uso de classes e métodos bem definidos para manipulação de dados.
* **Security & Scalability:** Implementação de **UUIDs** (Universally Unique Identifiers) e **PDO Prepared Statements** para proteção contra SQL Injection.
* **Modern PHP:** Uso de sintaxe Heredoc para queries SQL legíveis e propriedades tipadas.

---

## 🚀 How to Run

Cada uma das pastas acima possui seu próprio arquivo **README.md** com instruções detalhadas de instalação e requisitos específicos.

1. **Escolha a versão:** Você pode rodar qualquer uma das soluções de forma independente.
2. **Recomendação:** Recomendo vivamente a visualização da **[Architected Solution](./architected-solution)**, pois ela reflete melhor os meus padrões de código e preocupação com a engenharia de software.
