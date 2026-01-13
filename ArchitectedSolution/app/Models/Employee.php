<?php

namespace App\Models;

use Database\Database;
use DateTimeImmutable;
use PDO;

final class Employee extends AbstractDatabaseModel
{
    public function __construct(
        private string $name,
        private int $age,
        private string $job,
        private float $salary,
        private DateTimeImmutable $admissionDate,
        private ?int $id = null,
        private ?string $uuid = null,
    ) {}

    public static function tableName(): string
    {
        return 'employees';
    }

    public function id(): string
    {
        return $this->id;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function job(): string
    {
        return $this->job;
    }

    public function salary(): float
    {
        return $this->salary;
    }

    public function admissionDate(): DateTimeImmutable
    {
        return $this->admissionDate;
    }

    public function increaseSalary(float $percent): void
    {
        $this->salary *= 1 + ($percent / 100);
    }

    public function yearsInCompany(): int
    {
        return (int)$this->admissionDate->diff(new DateTimeImmutable())->y;
    }

    public function save(?PDO $connection = null): void
    {
        $connection ??= Database::getConnection();

        $sql = <<<SQL
            UPDATE employees
            SET name = :name, age = :age, job = :job, salary = :salary, admission_date = :admission_date
            WHERE uuid = :uuid
        SQL;

        if (empty($this->uuid) || !$this->exists($connection)) {
            $this->uuid = $this->generateV4Uuid();
            $sql = <<<SQL
                INSERT INTO employees (uuid, name, age, job, salary, admission_date)
                VALUES (:uuid, :name, :age, :job, :salary, :admission_date)
            SQL;
        }

        $connection->prepare($sql)->execute([
            'uuid'           => $this->uuid,
            'name'           => $this->name,
            'age'            => $this->age,
            'job'            => $this->job,
            'salary'         => $this->salary,
            'admission_date' => $this->admissionDate->format('Y-m-d'),
        ]);
    }

    private function exists(PDO $connection): bool
    {
        if (empty($this->id)) return false;
        $stmt = $connection->prepare("SELECT 1 FROM employees WHERE id = ?");
        $stmt->execute([$this->uuid]);
        return (bool) $stmt->fetchColumn();
    }

    protected static function fromRow(array $row): static
    {
        return new static(
            $row['name'],
            (int)$row['age'],
            $row['job'],
            (float)$row['salary'],
            new DateTimeImmutable($row['admission_date']),
            $row['id'],
            $row['uuid'],
        );
    }
}
