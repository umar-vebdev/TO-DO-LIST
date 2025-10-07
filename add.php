<?php

require 'db.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];


$sql = "INSERT INTO tasks (title, description, due_date) VALUES (:title, :description, :due_date)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['title' => $title, 'description' => $description, 'due_date' => $due_date]);

header("location: index.php");
exit;
}