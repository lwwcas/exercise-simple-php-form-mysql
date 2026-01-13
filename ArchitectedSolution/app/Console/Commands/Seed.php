<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Database\Database;
use Database\Seeders\SeederInterface;

final class Seed
{
    public function run(): void
    {
        echo PHP_EOL . 'Running database seeders...' . PHP_EOL;

        $connection = Database::getConnection();
        $seeders = $this->loadSeeders();

        foreach ($seeders as $seederClass) {
            /** @var SeederInterface $seeder */
            $seeder = new $seederClass($connection);
            $seeder->run();

            echo "✔ Seeded: {$seederClass}" . PHP_EOL;
        }

        echo PHP_EOL . 'Database seeded successfully.' . PHP_EOL;
    }

    private function loadSeeders(): array
    {
        $path = dirname(__DIR__, 3) . '/database/seeders/*.php';

        foreach (glob($path) as $file) {
            require_once $file;
        }

        return array_values(
            array_filter(
                get_declared_classes(),
                fn (string $class) =>
                    is_subclass_of($class, SeederInterface::class)
            )
        );
    }
}
