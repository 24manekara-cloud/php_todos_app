<?php
require 'db.php';

$today = date('Y-m-d');

// Todos due today
$dueToday = $conn->query("SELECT * FROM todos WHERE due_date = '$today' ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);

// All todos
$todos = $conn->query("SELECT * FROM todos ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        header, footer {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
        }
        main {
            max-width: 800px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        .todo-card {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .todo-card span {
            font-weight: bold;
        }
        .todo-buttons button {
            margin-left: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }
        .btn-complete { background-color: #28a745; }
        .btn-complete:hover { background-color: #218838; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-edit:hover { background-color: #e0a800; }
        .btn-delete { background-color: #dc3545; }
        .btn-delete:hover { background-color: #c82333; }
        a.add-todo {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a.add-todo:hover {
            background-color: #0056b3;
        }
        .section-title {
            margin-top: 20px;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>My Todo App</h1>
</header>

<main>
    <h2 class="section-title">Due Today</h2>
    <?php if (count($dueToday) > 0): ?>
        <?php foreach ($dueToday as $todo): ?>
            <div class="todo-card">
                <span><?= htmlspecialchars($todo['description']) ?></span>
                <div class="todo-buttons">
                    <a href="mark_completed.php?id=<?= $todo['id'] ?>"><button class="btn-complete">Mark Completed</button></a>
                    <a href="edit_todo.php?id=<?= $todo['id'] ?>"><button class="btn-edit">Edit</button></a>
                    <a href="delete_todo.php?id=<?= $todo['id'] ?>" onclick="return confirm('Are you sure?')"><button class="btn-delete">Delete</button></a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No todos due today.</p>
    <?php endif; ?>

    <h2 class="section-title">All Todos</h2>
    <?php foreach ($todos as $todo): ?>
        <div class="todo-card">
            <span><?= htmlspecialchars($todo['description']) ?> (<?= $todo['status'] ?>)</span>
            <div class="todo-buttons">
                <?php if ($todo['status'] != 'completed'): ?>
                    <a href="mark_completed.php?id=<?= $todo['id'] ?>"><button class="btn-complete">Mark Completed</button></a>
                <?php endif; ?>
                <a href="edit_todo.php?id=<?= $todo['id'] ?>"><button class="btn-edit">Edit</button></a>
                <a href="delete_todo.php?id=<?= $todo['id'] ?>" onclick="return confirm('Are you sure?')"><button class="btn-delete">Delete</button></a>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="create_todo.php" class="add-todo">+ Add New Todo</a>
</main>

<footer>
    &copy; <?= date('Y') ?> My Todo App. All rights reserved.
</footer>

</body>
</html>
