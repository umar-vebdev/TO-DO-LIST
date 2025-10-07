<?php

require 'db.php';

$id = $_GET['id'] ?? NULL;

if($id) {
$sql = "DELETE FROM tasks WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
}

header("location: index.php");