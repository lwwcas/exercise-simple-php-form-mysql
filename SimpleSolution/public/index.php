<?php
require_once '../src/Database/Database.php';
require_once '../src/Model/Employeer.php';

$db = Database::getConnection();
$employeer = new Employeer($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeer->setName($_POST['name']);
    $employeer->setAge((int) $_POST['age']);
    $employeer->setJob($_POST['job']);
    $employeer->setSalary((float) $_POST['salary']);
    $employeer->setAdmissionDate($_POST['admission_date']);
    $employeer->save();

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

            <?php if (!empty($message)): ?>
                <p class="success"><?= $message ?></p>
            <?php endif; ?>

            <form method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="number" name="age" placeholder="Age" required>
                <input type="text" name="job" placeholder="Job" required>
                <input type="number" step="0.01" name="salary" placeholder="Salary" required>
                <input type="date" name="admission_date" required>

                <div class="button-group">
                    <button type="submit" class="btn-save">Save</button>
                    <a href="list.php" class="btn-list">View Employee List</a>
                </div>
            </form>
        </div>
    </body>
</html>
