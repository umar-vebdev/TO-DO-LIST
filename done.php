<?php
require 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {

    $stmt = $pdo->prepare("SELECT is_done FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $task = $stmt->fetch();

    if ($task) {

        $new_status = $task['is_done'] ? 0 : 1;

        $update = $pdo->prepare("UPDATE tasks SET is_done = :status WHERE id = :id");
        $update->execute([
            'status' => $new_status,
            'id' => $id
        ]);
    }
}


header("Location: index.php");
exit;

