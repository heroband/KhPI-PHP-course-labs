<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    1 => "laptop",
    2 => "phone",
    3 => "headphones"
];

// Додавання товару в корзину
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (isset($products[$id])) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

        // Збереження в кукі попередніх покупок
        $previous_purchases = isset($_COOKIE['previous_purchases']) ? json_decode($_COOKIE['previous_purchases'], true) : [];
        $previous_purchases[$id] = ($previous_purchases[$id] ?? 0) + 1;
        setcookie('previous_purchases', json_encode($previous_purchases), time() + 3600 * 24 * 30); // 30 днів
    }

    header("Location: cart.php");
    exit;
}


// Очищення корзини
if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    unset($_SESSION['cart']); // Видаляємо корзину
    header("Location: cart.php");
    exit;
}


// Отримуємо дані з кукі
$previous_purchases = isset($_COOKIE['previous_purchases']) ? json_decode($_COOKIE['previous_purchases'], true) : [];

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кошик</title>
</head>
<body>
<h2>Корзина</h2>
    <ul>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                <li><?= htmlspecialchars($products[$id]) ?> - <?= $quantity ?> шт.</li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Корзина порожня</p>
        <?php endif; ?>
    </ul>

    <h2>Попередні покупки</h2>
    <ul>
        <?php if (!empty($previous_purchases)): ?>
            <?php foreach ($previous_purchases as $id => $quantity): ?>
                <li><?= htmlspecialchars($products[$id]) ?> - <?= $quantity ?> шт.</li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Немає попередніх покупок</p>
        <?php endif; ?>
    </ul>

    <p><a href="index.php">Продовжити покупки</a></p>
    <p><a href="cart.php?action=clear">Очистити корзину</a></p>
</body>
</html>