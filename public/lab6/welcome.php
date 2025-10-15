<?php
session_start();

if (!isset($_SESSION['user_session_username'])) {
    header("Location: login_form.html");
    exit();
}

echo "Привіт, ".$_SESSION['user_session_username']."! Це ваша закрита сторінка. ";
echo "<a href=\"./logout.php\">Вийти з аккаунту</a>";
