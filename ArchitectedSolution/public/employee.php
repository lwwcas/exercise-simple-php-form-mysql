<?php

declare(strict_types=1);

use App\Models\Employee;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/app.php';

// Fetch all employees
$employees = Employee::all(); // returns an array of Employee objects

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container list-container">
    <header class="list-header">
        <h1>Employees</h1>
        <a href="index.php" class="btn-new">+ New</a>
        <a href="projects.php" class="btn-new">Projects List</a>
    </header>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Salary</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($employees)): ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No employees found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($employees as $emp): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($emp->name(), ENT_QUOTES) ?></strong><br>
                                <small class="uuid-text"><?= substr($emp->uuid(), 0, 8) ?>...</small>
                            </td>
                            <td><?= htmlspecialchars($emp->job(), ENT_QUOTES) ?></td>
                            <td>$<?= number_format($emp->salary(), 2) ?></td>
                            <td><?= $emp->admissionDate()->format('M d, Y') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
