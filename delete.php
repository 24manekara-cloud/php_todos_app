<?php
require 'db.php';

$id = $_GET['id'];
$query = 'DELETE FROM todos WHERE id = ?';
$statement = $pdo->prepare($query);
$statement->execute([$id]);

header('Location: index.php');
exit;
