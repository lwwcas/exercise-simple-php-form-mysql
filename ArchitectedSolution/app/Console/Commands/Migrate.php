<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Database\Database;
use Database\Migrations\AbstractMigration;

final class Migrate
{
    /**
     * Run all migrations in order
     */
    public function run(): void
    {
        $this->printHeader();

        $connection = Database::getConnection();

        $migrationClasses = $this->loadMigrationClasses();

        foreach ($migrationClasses as $migrationClass) {
            $migration = new $migrationClass($connection);
            $migration->up();

            $this->printMigrated($migrationClass);
        }

        $this->printSuccess();
    }

    /**
     * Load migration class names in execution order
     */
    private function loadMigrationClasses(): array
    {
        $projectRoot = dirname(__DIR__, 3);
        $migrationDir = $projectRoot . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations';
        $migrationPath = $migrationDir . DIRECTORY_SEPARATOR . '*.php';

        $files = glob($migrationPath);
        sort($files);

        $classes = [];
        foreach ($files as $file) {
            // 1. Ignora o arquivo AbstractMigration.php e arquivos que não começam com números
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            if ($fileName === 'AbstractMigration' || strpos($fileName, '_') === false) {
                continue;
            }

            // 2. Lê o conteúdo do arquivo para descobrir o nome REAL da classe
            // Isso resolve o problema de o arquivo ter números no nome mas a classe não
            $content = file_get_contents($file);
            if (preg_match('/class\s+([a-zA-Z0-9_]+)/', $content, $matches)) {
                $className = $matches[1];
                $fullClass = "Database\\Migrations\\$className";

                // 3. Importa o arquivo manualmente apenas se a classe ainda não existir
                if (!class_exists($fullClass, false)) {
                    require_once $file;
                }

                if (class_exists($fullClass) && is_subclass_of($fullClass, AbstractMigration::class)) {
                    $classes[] = $fullClass;
                }
            }
        }

        return $classes;
    }

    /**
     * Print CLI header
     */
    private function printHeader(): void
    {
        echo PHP_EOL . "🚀 Running database migrations..." . PHP_EOL;
    }

    /**
     * Print each migrated class
     */
    private function printMigrated(string $migration): void
    {
        echo "✔ Migrated: {$migration}" . PHP_EOL;
    }

    /**
     * Print success message
     */
    private function printSuccess(): void
    {
        echo PHP_EOL . "✅ All migrations completed successfully." . PHP_EOL;
    }
}
