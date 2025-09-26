<?php
session_start();

$timeout = 300;
if (isset($_SESSION["last_activity"]) && time() - $_SESSION["last_activity"] > $timeout) {
    session_unset();
    session_destroy();
    header("Location: login_form.html?expired=1");
    exit;
}
$_SESSION["last_activity"] = time();

if (!isset($_SESSION["active_user_login"])) {
    header("Location: login_form.html");
    exit;
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product"])) {
    $product = $_POST["product"];
    $_SESSION["cart"][] = $product;

    $previous = isset($_COOKIE["previous_cart"]) ? json_decode($_COOKIE["previous_cart"], true) : [];
    $previous[] = $product;

    setcookie("previous_cart", json_encode($previous), time() + 3600 * 24 * 30, "/");
}

echo "<h2>Your cart (session):</h2>";
if (!empty($_SESSION["cart"])) {
    echo "<ul>";
    foreach ($_SESSION["cart"] as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Cart is empty</p>";
}

echo "<h2>Previous purchases (cookie):</h2>";
if (!empty($_COOKIE["previous_cart"])) {
    $items = json_decode($_COOKIE["previous_cart"], true);
    echo "<ul>";
    foreach ($items as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No previous purchases</p>";
}
?>

<form method="post">
    <input type="text" name="product" placeholder="Enter product name" required>
    <button type="submit">Add to cart</button>
</form>

<p><a href="login_user.php">Back to menu</a></p>
