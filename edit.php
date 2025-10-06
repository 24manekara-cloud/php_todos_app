<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = 'UPDATE todos SET description = ?, due_date = ?, is_completed = ? WHERE id = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([
        $_POST['description'],
        $_POST['due_date'],
        isset($_POST['is_completed']) ? 1 : 0,
        $_POST['id']
    ]);
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$query = 'SELECT * FROM todos WHERE id = ?';
$statement = $pdo->prepare($query);
$statement->execute([$id]);
$todo = $statement->fetch();

require 'views/edit.html';
