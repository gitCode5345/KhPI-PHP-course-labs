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

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login_user.php");
    exit;
}

echo "<h2>Server & Request Info</h2>";
echo "<p>Client IP: " . $_SERVER["REMOTE_ADDR"] . "</p>";
echo "<p>Browser: " . $_SERVER["HTTP_USER_AGENT"] . "</p>";
echo "<p>Script name: " . $_SERVER["PHP_SELF"] . "</p>";
echo "<p>Request method: " . $_SERVER["REQUEST_METHOD"] . "</p>";
echo "<p>File path: " . $_SERVER["SCRIPT_FILENAME"] . "</p>";

echo "<p><a href=\"login_user.php\">Back to menu</a></p>";
