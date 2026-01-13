<?php
require_once '../src/Database/Database.php';
require_once '../src/Model/Employeer.php';

$db = Database::getConnection();
$employeerModel = new Employeer($db);

$employees = $employeerModel->getAll();
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
                        <tr><td colspan="4" style="text-align:center;">No employees found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($employees as $emp): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($emp['name']) ?></strong><br>
                                    <small class="uuid-text"><?= substr($emp['uuid'], 0, 8) ?>...</small>
                                </td>
                                <td><?= htmlspecialchars($emp['job']) ?></td>
                                <td>$<?= number_format($emp['salary'], 2) ?></td>
                                <td><?= date('M d, Y', strtotime($emp['admission_date'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
