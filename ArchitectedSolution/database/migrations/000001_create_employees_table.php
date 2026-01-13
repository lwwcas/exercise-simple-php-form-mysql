<?php

namespace Database\Migrations;

final class CreateEmployeesTable extends AbstractMigration
{
    public function up(): void
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS employees (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                uuid CHAR(36) NOT NULL,
                name VARCHAR(100) NOT NULL,
                age INT NOT NULL,
                job VARCHAR(100) NOT NULL,
                salary DECIMAL(10,2) NOT NULL,
                admission_date DATE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                UNIQUE KEY uq_employees_id (id),
                INDEX idx_employees_job (job)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        SQL;

        $this->connection->exec($sql);
    }

    public function down(): void
    {
        $sql = <<<SQL
            DROP TABLE IF EXISTS employees;
        SQL;

        $this->connection->exec($sql);
    }
}
