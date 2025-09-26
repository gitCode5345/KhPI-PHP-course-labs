<?php
$cookie_name = "username";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cookie_value = $_POST["username"];
    if ($_POST["action"] == "set") {
        if (empty($cookie_value)) {
            echo "<p>Please, enter name</p>";
            return;
        }

        setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/");
        echo "<p>Data save</p>";
    } elseif ($_POST["action"] == "delete") {
        setcookie($cookie_name, "", time() - 3600, "/");
        echo "<p>Cookie deleted</p>";
    }
} elseif (isset($_COOKIE[$cookie_name])) {
    echo "<p>Hello, ".$_COOKIE[$cookie_name]."</p>";
} else {
    echo "<p>No saved cookies found</p>";
}
