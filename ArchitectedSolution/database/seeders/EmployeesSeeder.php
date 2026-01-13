<?php

declare(strict_types=1);

namespace Database\Seeders;

use PDO;

final class EmployeesSeeder implements SeederInterface
{
    public function __construct(
        private PDO $connection
    ) {}

    public function run(): void
    {
        $employees = [
            [
                'uuid' => $this->uuid(),
                'name' => 'John Doe',
                'age' => 30,
                'job' => 'Software Engineer',
                'salary' => 3500.00,
                'admission_date' => '2022-03-01',
            ],
            [
                'uuid' => $this->uuid(),
                'name' => 'Jane Smith',
                'age' => 28,
                'job' => 'Project Manager',
                'salary' => 4200.00,
                'admission_date' => '2021-07-15',
            ],
            [
                'uuid' => $this->uuid(),
                'name' => 'Michael Brown',
                'age' => 40,
                'job' => 'Tech Lead',
                'salary' => 5200.00,
                'admission_date' => '2019-01-10',
            ],
        ];

        $sql = <<<SQL
            INSERT INTO employees (uuid, name, age, job, salary, admission_date)
            VALUES (:uuid, :name, :age, :job, :salary, :admission_date)
        SQL;

        $statement = $this->connection->prepare($sql);

        foreach ($employees as $employee) {
            $statement->execute($employee);
        }
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
