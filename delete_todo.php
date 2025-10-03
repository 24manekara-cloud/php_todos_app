<?php
require 'db.php';

$id = (int)($_GET['id'] ?? 0);
$conn->query("DELETE FROM todos WHERE id=$id");
header('Location: list_todos.php');
exit;
