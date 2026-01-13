<?php

declare(strict_types=1);

use App\Models\Project;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/app.php';

// Fetch all projects
$projects = Project::all(); // returns an array of Project objects

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container list-container">
    <header class="list-header">
        <h1>Projects</h1>
        <a href="employee.php" class="btn-new">Employee List</a>
    </header>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Employee ID</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Delivery Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($projects)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No projects found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= htmlspecialchars($project->description(), ENT_QUOTES) ?></td>
                            <td><small class="uuid-text"><?= $project->employeeName() ?></small></td>
                            <td>$<?= number_format($project->value(), 2) ?></td>
                            <td><?= htmlspecialchars($project->status()->name, ENT_QUOTES) ?></td>
                            <td><?= $project->deliveryDate()->format('M d, Y') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
