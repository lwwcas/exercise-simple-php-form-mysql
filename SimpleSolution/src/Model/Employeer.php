<?php

class Employeer
{
    private int $id;
    private string $uuid;
    private string $name;
    private int $age;
    private string $job;
    private float $salary;
    private string $admissionDate;

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    public function setAdmissionDate(string $date): void
    {
        $this->admissionDate = $date;
    }

    public function getAverageAge(): float
    {
        $sql = <<<SQL
            SELECT AVG(age) AS average_age
            FROM employees
        SQL;

        $result = $this->db->query($sql)->fetch();
        return (float) ($result['average_age'] ?? 0);
    }

    public function getSimulateSalaryIncrease(float $percentage): array
    {
        $sql = <<<SQL
            SELECT
                uuid,
                name,
                salary,
                salary * (1 + :percentage / 100) AS new_salary
            FROM employees
        SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['percentage' => $percentage]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllJobs(): array
    {
        $sql = <<<SQL
            SELECT DISTINCT job
            FROM employees
            ORDER BY job ASC
        SQL;

        return $this->db->query($sql)->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getDeliveredProjectsCurrentYear(): array
    {
        $sql = <<<SQL
            SELECT p.*
            FROM projects p
            WHERE p.status IN ('completed', 'delivered')
              AND YEAR(p.delivery_date) = YEAR(CURDATE())
            ORDER BY p.value DESC
        SQL;

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectsToDeliverByDateRange(string $start, string $end): array
    {
        $sql = <<<SQL
            SELECT
                e.uuid AS employee_uuid,
                e.name,
                p.uuid AS project_uuid,
                p.description,
                p.delivery_date
            FROM projects p
            JOIN employees e ON e.id = p.employee_id
            WHERE p.delivery_date BETWEEN :start AND :end
              AND p.status = 'pending'
            ORDER BY p.delivery_date ASC
        SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'start' => $start,
            'end'   => $end
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        $sql = <<<SQL
            SELECT id, uuid, name, job, salary, admission_date
            FROM employees
            ORDER BY id DESC
        SQL;

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(): void
    {
        $sql = <<<SQL
            INSERT INTO employees (uuid, name, age, job, salary, admission_date)
            VALUES (UUID(), :name, :age, :job, :salary, :admission_date)
        SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'name'           => $this->name,
            'age'            => $this->age,
            'job'            => $this->job,
            'salary'         => $this->salary,
            'admission_date' => $this->admissionDate
        ]);
    }
}
