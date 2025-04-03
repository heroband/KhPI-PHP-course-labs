<?php
session_start();

$products = [
    1 => "laptop",
    2 => "phone",
    3 => "headphones"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
<h2>Товари</h2>
    <ul>
        <?php foreach ($products as $id => $name): ?>
            <li>
                <?= htmlspecialchars($name) ?>
                <a href="cart.php?action=add&id=<?= $id ?>">Add to cart</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <p><a href="cart.php">Go to cart</a></p>
</body>
</html>
