<?php
session_start();

const CORRECT_LOGIN = "login123";
const CORRECT_PASS = "pass123";

$timeout = 300;
if (isset($_SESSION["last_activity"]) && time() - $_SESSION["last_activity"] > $timeout) {
    session_unset();
    session_destroy();
    header("Location: login_form.html?expired=1");
    exit;
}
$_SESSION["last_activity"] = time();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login-input"];
    $password = $_POST["password-input"];

    if (($login === CORRECT_LOGIN && $password === CORRECT_PASS)) {
        echo "<p>You are successfully logged in.</p>";
        $_SESSION["active_user_login"] = $login;
        header("Location: login_user.php");
    } else {
        echo "<p>Failed to log in, please check your username or password.</p>";
    }
} else {
    if (isset($_SESSION["active_user_login"])) {
    echo "<h2>Menu</h2>";
    echo "<ul>
            <li><form action=\"server_info.php\" method=\"post\">
                    <button type=\"submit\">Server Info</button>
                </form>
            </li>
            <li><a href=\"cart.php\">Shopping Cart</a></li>
            <li>
              <form action=\"logout.php\" method=\"post\">
                <button type=\"submit\">Logout</button>
              </form>
            </li>
          </ul>";
} else {
    echo "<p><a href=\"login_form.html\">Go back to login</a></p>";
}
}
