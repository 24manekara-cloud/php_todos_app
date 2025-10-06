<?php
require 'db.php';
require 'classes/Todo.php';

$query = 'SELECT * FROM todos';
$statement = $pdo->prepare($query);
$statement->execute();
$rows = $statement->fetchAll();

$todos = [];
foreach ($rows as $row) {
    $todo = new Todo($row['description'], $row['due_date']);
    if ($row['is_completed']) {
        $todo->markAsCompleted();
    }
    $todo->id = $row['id'];
    $todos[] = $todo;
}

require 'views/index.html';
