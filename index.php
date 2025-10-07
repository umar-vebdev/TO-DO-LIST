<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM tasks ORDER BY id DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>📝 Мой To-Do List</h1>

    <form action="add.php" method="POST" class="add-form">
      <input type="text" name="title" placeholder="Название задачи" required>
      <textarea name="description" placeholder="Описание..."></textarea>
      <input type="date" name="due_date">
      <button type="submit">Добавить</button>
    </form>

    <hr>

    <div class="task-list">
      <?php if (count($tasks) > 0): ?>
        <?php foreach ($tasks as $task): ?>
          <div class="task <?= $task['is_done'] ? 'completed' : '' ?>">
            <div class="task-info">
              <h3><?= htmlspecialchars($task['title']) ?></h3>

              <?php if (!empty($task['description'])): ?>
                <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
              <?php endif; ?>

              <?php if (!empty($task['due_date'])): ?>
                <span class="date">📅 Срок: <?= htmlspecialchars($task['due_date']) ?></span>
              <?php endif; ?>

              <span class="created">🕒 Добавлено: <?= htmlspecialchars($task['created_at']) ?></span>
            </div>

            <div class="actions">
              <a href="done.php?id=<?= $task['id'] ?>" class="done">✔</a>
              <a href="delete.php?id=<?= $task['id'] ?>" class="delete">🗑️</a>
              <a href="update.php?id=<?= $task['id'] ?>" class="update">✏️</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Пока нет задач 🙌</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
