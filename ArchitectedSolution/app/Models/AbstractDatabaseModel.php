<?php

declare(strict_types=1);

namespace App\Models;

use Database\Database;
use PDO;

abstract class AbstractDatabaseModel
{
    // -------------------------------
    // Generic find by column and value
    // -------------------------------
    public static function find(string $column, string|int $value, ?PDO $connection = null): ?static
    {
        $connection ??= Database::getConnection();

        $sql = "SELECT * FROM " . static::tableName() . " WHERE {$column} = :value LIMIT 1";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['value' => $value]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return static::fromRow($row);
    }

    // -------------------------------
    // Generic where returning multiple results
    // -------------------------------
    public static function where(array $conditions, ?PDO $connection = null): array
    {
        $connection ??= Database::getConnection();

        $clauses = [];
        foreach ($conditions as $col => $val) {
            $clauses[] = "{$col} = :{$col}";
        }

        $sql = "SELECT * FROM " . static::tableName() . " WHERE " . implode(' AND ', $clauses);
        $stmt = $connection->prepare($sql);
        $stmt->execute($conditions);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $results = [];
        foreach ($rows as $row) {
            $results[] = static::fromRow($row);
        }

        return $results;
    }

    public static function all(): array
    {
        $connection = Database::getConnection();

        $table = static::tableName();
        $stmt = $connection->query("SELECT * FROM {$table}");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($row) => static::fromRow($row), $rows);
    }

    /**
     * Gera um UUID v4 (RFC 4122)
     */
    public function generateV4Uuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    abstract protected static function fromRow(array $row): static;

    abstract public static function tableName(): string;

    abstract public function save(?PDO $connection = null): void;
}
