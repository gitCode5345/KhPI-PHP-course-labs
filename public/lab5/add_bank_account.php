<?php
require_once "./BankAccount.php";
require_once "./SavingsAccount.php";

session_start();

if (!isset($_SESSION["bank_account_def"])) {
    $_SESSION["bank_account_def"] = [];
}

if (!isset($_SESSION["bank_account_saving"])) {
    $_SESSION["bank_account_saving"] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST["add_account_default"])) {
            $_SESSION["bank_account_def"][] = new BankAccount($_POST["balance"], $_POST["currency"]);
            echo "<p>Аккаунт успішно додано!</p>";
        } elseif (isset($_POST["add_account_saving"])) {
            $_SESSION["bank_account_saving"][] = new SavingsAccount($_POST["balance"], $_POST["currency"]);
            echo "<p>Аккаунт успішно додано!</p>";
        }
    } catch (Exception $th) {
        echo "<p style='color: red;'>Помилка: " . $e->getMessage() . "</p>";
    }
}
