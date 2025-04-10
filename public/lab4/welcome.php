<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Ласкаво просимо</title>
</head>
<body>
    <h1>Вітаємо, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>Це захищена сторінка</p>
    <a href="logout.php">Вийти</a>
</body>
</html>