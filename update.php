<?php

require 'db.php';

$id = $_GET['id'] ?? null;
if(!$id) {
    die("Не передан ID");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? NULL;

$sql = "UPDATE tasks SET title = :title, description = :description, due_date = :due_date WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['title' => $title, 'description' => $description, 'due_date' => $due_date, 'id' => $id]);

header("location: index.php");
}

$sql = "SELECT * FROM tasks WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$task = $stmt->fetch();

if(!$task) {
    die("Задача не найдена");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Редактировать задачу</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container edit-page">
    <h1>✏️ Редактировать задачу</h1>

    <form method="POST" class="edit-form">
      <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
      <textarea name="description" placeholder="Описание..."><?= htmlspecialchars($task['description']) ?></textarea>
      <input type="date" name="due_date" value="<?= htmlspecialchars($task['due_date']) ?>">
      <button type="submit">💾 Сохранить</button>
      <a href="index.php" class="cancel">Отмена</a>
    </form>
  </div>
</body>
</html>