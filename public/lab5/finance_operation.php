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

$append_arrays = array_merge(
    array_values($_SESSION["bank_account_def"]),
    array_values($_SESSION["bank_account_saving"])
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST["deposit_money"])) {
            $append_arrays[$_POST["select-acc"]]->deposit($_POST["money"]);
            echo "Кошти успішно додано, {$append_arrays[$_POST["select-acc"]]->getBalance()}";
        } elseif (isset($_POST["withdraw_money"])) {
            $append_arrays[$_POST["select-acc"]]->withdraw($_POST["money"]);
            echo "Кошти успішно знято, {$append_arrays[$_POST["select-acc"]]->getBalance()}";
        }
    } catch (Exception $th) {
        echo "<p style='color: red;'>Помилка: " . $e->getMessage() . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance operations</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="form-box">
            <label>Оберіть аккаунт та суму яку хочете покласти</label>
            <select name="select-acc" class="input-form">
                <?php
                if (!empty($append_arrays)) {
                    foreach ($append_arrays as $i => $acc) {
                        echo "<option value=\"$i\">Account $i: {$acc->getBalance()}</option>";
                    }
                }
                ?>
            </select>
            <input type="number" min="0" name="money" class="input-form">
            <button type="submit" name="deposit_money">Покласти кошти</button>
        </form>
        <form action="" method="POST" class="form-box">
            <label>Оберіть аккаунт та суму яку хочете зняти</label>
            <select name="select-acc" class="input-form">
                <?php
                foreach ($append_arrays as $i => $acc) {
                    echo "<option value=\"$i\">Account $i: {$acc->getBalance()}</option>";
                }
                ?>
            </select>
            <input type="number" min="0" name="money" class="input-form">
            <button type="submit" name="withdraw_money">Зняти кошти</button>
        </form>
    </div>
</body>

</html>