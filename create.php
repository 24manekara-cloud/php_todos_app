<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['description']) || empty($_POST['due_date'])) {
        $errorMessage = "All fields are required";
    } else {
        $query = 'INSERT INTO todos (description, due_date, is_completed) VALUES (?, ?, 0)';
        $statement = $pdo->prepare($query);

        if ($statement->execute([$_POST['description'], $_POST['due_date']])) {
            $successMessage = "Todo created successfully";
        }
    }
}

require 'views/create.html';
