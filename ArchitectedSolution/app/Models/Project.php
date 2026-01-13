<?php

namespace App\Models;

use App\Enums\ProjectStatusEnum;
use Database\Database;
use DateTimeImmutable;
use PDO;

final class Project extends AbstractDatabaseModel
{
    public function __construct(
        private int $employeeId,
        private string $description,
        private float $value,
        private ProjectStatusEnum $status,
        private DateTimeImmutable $deliveryDate,
        private ?int $id = null,
        private ?string $uuid = null,
    )
    {
    }

    public static function tableName(): string
    {
        return 'projects';
    }

    public function id(): string
    {
        return $this->id;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function employeeId(): int
    {
        return $this->employeeId;
    }

    public function employeeName(): string
    {
        $employeeId = $this->employeeId();
        $employee = Employee::find('id', $employeeId);
        return $employee->name();
    }

    public function description(): string
    {
        return $this->description;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function status(): ProjectStatusEnum
    {
        return $this->status;
    }

    public function deliveryDate(): DateTimeImmutable
    {
        return $this->deliveryDate;
    }

    public function markAsDelivered(): void
    {
        $this->status = ProjectStatusEnum::DELIVERED;
    }

    public function isOverdue(): bool
    {
        return $this->deliveryDate < new DateTimeImmutable() && $this->status !== ProjectStatusEnum::DELIVERED;
    }

    public function save(?PDO $connection = null): void
    {
        $connection ??= Database::getConnection();

        $sql = <<<SQL
            UPDATE projects
            SET description = :description,
                value = :value,
                status = :status,
                delivery_date = :delivery_date
            WHERE uuid = :uuid
        SQL;

        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'description' => $this->description,
            'value' => $this->value,
            'status' => $this->status->value,
            'delivery_date' => $this->deliveryDate->format('Y-m-d'),
            'uuid' => $this->uuid
        ]);
    }

    public static function fromRow(array $row): static
    {
        return new static(
            (int) $row['employee_id'],
            $row['description'],
            (float) $row['value'],
            ProjectStatusEnum::from($row['status']),
            new DateTimeImmutable($row['delivery_date']),
            $row['id'],
            $row['uuid'],
        );
    }
}
