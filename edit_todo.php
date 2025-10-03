<?php
require 'db.php';

$id = (int)($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim($_POST['description']);
    $due_date = $_POST['due_date'];
    $conn->query("UPDATE todos SET description='$description', due_date='$due_date' WHERE id=$id");
    header('Location: list_todos.php');
    exit;
}

$todo = $conn->query("SELECT * FROM todos WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Todo</title>
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
            max-width: 600px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            text-align: center;
        }
        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        form input[type="text"],
        form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        form button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        a.back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
        }
        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>My Todo App</h1>
</header>

<main>
    <h2>Edit Todo</h2>
    <form method="post">
        <label>Description:</label>
        <input type="text" name="description" value="<?= htmlspecialchars($todo['description']) ?>" required>

        <label>Due Date:</label>
        <input type="date" name="due_date" value="<?= $todo['due_date'] ?>">

        <button type="submit">Update Todo</button>
    </form>
    <a href="list_todos.php" class="back-link">← Back to Todo List</a>
</main>

<footer>
    &copy; <?= date('Y') ?> My Todo App. All rights reserved.
</footer>

</body>
</html>
