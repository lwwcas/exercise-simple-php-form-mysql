<?php

declare(strict_types=1);

// -------------------------------------
// Composer autoload
// -------------------------------------
require_once dirname(__DIR__) . '/vendor/autoload.php';

// -------------------------------------
// Load environment variables
// -------------------------------------
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// -------------------------------------
// Default application settings
// -------------------------------------
date_default_timezone_set('Europe/Lisbon');
