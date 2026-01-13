<?php

namespace Database\Migrations;

final class CreateProjectsTable extends AbstractMigration
{
    public function up(): void
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS projects (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                uuid CHAR(36) NOT NULL,
                employee_id INT UNSIGNED NOT NULL,
                description VARCHAR(255) NOT NULL,
                value DECIMAL(10,2) NOT NULL,
                status VARCHAR(50) NOT NULL,
                delivery_date DATE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                UNIQUE KEY uq_projects_uuid (uuid),
                INDEX idx_projects_status (status),
                INDEX idx_projects_delivery_date (delivery_date),
                INDEX idx_projects_employee_id (employee_id),

                CONSTRAINT fk_projects_employee
                    FOREIGN KEY (employee_id)
                    REFERENCES employees (id)
                    ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        SQL;

        $this->connection->exec($sql);
    }

    public function down(): void
    {
        $sql = <<<SQL
            DROP TABLE IF EXISTS projects;
        SQL;

        $this->connection->exec($sql);
    }
}
