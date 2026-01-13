<?php

declare(strict_types=1);

// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap (dotenv, etc)
require_once __DIR__ . '/../bootstrap/app.php';

use App\Models\Employee;

$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee = new Employee(
        id: null,
        uuid: uniqid('emp_', true),
        name: $_POST['name'],
        age: (int) $_POST['age'],
        job: $_POST['job'],
        salary: (float) $_POST['salary'],
        admissionDate: new DateTimeImmutable($_POST['admission_date'])
    );

    $employee->save();

    $message = "Employee successfully created!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Create Employee</h1>

    <?php if ($message !== null): ?>
        <p class="success"><?= htmlspecialchars($message, ENT_QUOTES) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="job" placeholder="Job" required>
        <input type="number" step="0.01" name="salary" placeholder="Salary" required>
        <input type="date" name="admission_date" required>

        <div class="button-group">
            <button type="submit" class="btn-save">Save</button>
            <a href="employee.php" class="btn-list">View Employee List</a>
            <a href="projects.php" class="btn-list">Employee List</a>
        </div>
    </form>
</div>
</body>
</html>
