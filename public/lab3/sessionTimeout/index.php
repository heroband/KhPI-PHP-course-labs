<?php
session_start();
$inactive_time = 10;

if (isset($_SESSION['last_activity']) && (time()-$_SESSION['last_activity'] > $inactive_time)){
    session_unset();  // Очистити всі змінні сесії
    session_destroy(); // Знищити сесію
    header("Location: index.php?expired=1"); // Перезавантаження сторінки з повідомленням
    exit;
}
    
$_SESSION['last_activity'] = time();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions Timeout</title>
</head>
<body>
    <h2>Сторінка контролю активності</h2>

    <?php if (isset($_GET['expired'])): ?>
        <p style="color: red;">Сесія завершена через неактивність.</p>
    <?php endif; ?>

    <p>Остання активність: <?= date("H:i:s", $_SESSION['last_activity']) ?></p>
    <p>Якщо ви не будете активні 10 секунд, сесія завершиться.</p>

    <p><a href="index.php">Оновити сторінку</a></p>
</body>
</html>