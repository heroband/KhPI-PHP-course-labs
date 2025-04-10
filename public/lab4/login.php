<?php
session_start();

$host = 'mysql';
$db = getenv('MYSQL_DB');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');

// З'єднання з MySQL
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $message = "Помилка при запиті: " . $conn->error;
        $stmt->close();
    } else {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id, $user_name, $hashed_password);
            $stmt->fetch();

            if ($password === $hashed_password) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user_name;
                header('Location: welcome.php');
                exit();
            } else {
                $message = "Невірний пароль.";
            }
        } else {
            $message = "Користувача не знайдено.";
        }
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
</head>
<body>
    <h2>Вхід</h2>

    <?php if (!empty($message)) : ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label>Ім’я користувача: <input type="text" name="username" required></label><br>
        <label>Пароль: <input type="password" name="password" required></label><br>
        <button type="submit">Увійти</button>
    </form>
</body>
</html>