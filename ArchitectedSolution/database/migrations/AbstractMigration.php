<?php

namespace Database\Migrations;

use PDO;

abstract class AbstractMigration
{
    public function __construct(
        protected PDO $connection
    ) {}

    abstract public function up(): void;
    abstract public function down(): void;
}
