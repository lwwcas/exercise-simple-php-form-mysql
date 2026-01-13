<?php
declare(strict_types=1);

require __DIR__ . '/bootstrap/app.php';

use App\Console\Commands\Migrate;
use App\Console\Commands\Seed;

$command = $argv[1] ?? null;

switch ($command) {
    case 'migrate':
        (new Migrate())->run();
        break;
    case 'seed':
        (new Seed())->run();
        break;
    default:
        echo "Usage: php cli.php [migrate|seed]\n";
        break;
}
