<?php
require 'db.php';

$id = (int)($_GET['id'] ?? 0);
$conn->query("UPDATE todos SET status='completed' WHERE id=$id");
header('Location: list_todos.php');
exit;
