<?php

namespace App\Models;

use PDO;

interface DatabaseModelInterface
{
    // Table name
    public static function tableName(): string;

    // Find by primary key or UUID
    public static function find(PDO $connection, string $column, string|int $value): ?static;

    // Where clause returning multiple results
    public static function where(PDO $connection, array $conditions): array;

    // Save the current object in database
    public function save(PDO $connection): void;
}
