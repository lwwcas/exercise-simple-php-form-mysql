<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\ProjectStatusEnum;
use PDO;

final class ProjectsSeeder implements SeederInterface
{
    public function __construct(
        private PDO $connection
    ) {}

    public function run(): void
    {
        $employeesId = $this->fetchEmployeesId();

        if (empty($employeesId)) {
            return;
        }

        $projects = [
            [
                'uuid' => $this->uuid(),
                'employee_id' => $employeesId[0],
                'description' => 'Internal Management System',
                'value' => 15000.00,
                'status' => ProjectStatusEnum::COMPLETED->value,
                'delivery_date' => '2024-02-15',
            ],
            [
                'uuid' => $this->uuid(),
                'employee_id' => $employeesId[1],
                'description' => 'E-commerce Platform',
                'value' => 28000.00,
                'status' => ProjectStatusEnum::DELIVERED->value,
                'delivery_date' => '2024-06-01',
            ],
            [
                'uuid' => $this->uuid(),
                'employee_id' => $employeesId[2],
                'description' => 'Mobile App Development',
                'value' => 12000.00,
                'status' => ProjectStatusEnum::PENDING->value,
                'delivery_date' => '2025-01-10',
            ],
        ];

        $sql = <<<SQL
            INSERT INTO projects (
                uuid,
                employee_id,
                description,
                value,
                status,
                delivery_date
            ) VALUES (
                :uuid,
                :employee_id,
                :description,
                :value,
                :status,
                :delivery_date
            )
        SQL;

        $statement = $this->connection->prepare($sql);

        foreach ($projects as $project) {
            $statement->execute($project);
        }
    }

    private function fetchEmployeesId(): array
    {
        $sql = <<<SQL
            SELECT id FROM employees
            ORDER BY created_at ASC
        SQL;

        return $this->connection
            ->query($sql)
            ->fetchAll(PDO::FETCH_COLUMN);
    }

    private function uuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff)
        );
    }
}
