<?php
    require_once "./SavingsAccount.php";

    session_start();

    if (!isset($_SESSION["bank_account_saving"])) {
        $_SESSION["bank_account_saving"] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["bank_account_saving"][$_POST["select-saving-acc"]]->applyInterest();

        echo "Нараховано відсоток у розмірі: ".
        $_SESSION["bank_account_saving"][$_POST["select-saving-acc"]]->getInterestRate().
        ". Новий баланс: ".$_SESSION["bank_account_saving"][$_POST["select-saving-acc"]]->getBalance();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="" class="form-box">
            <select name="select-saving-acc">
                <?php
                    $i = 0;
                    foreach ($_SESSION["bank_account_saving"] as $acc) {
                        echo "<option value=\"$i\">Account $i: {$acc->getBalance()}</option>";
                        $i += 1;
                    }
                ?>
            </select>
            <button type="submit" class="btn-submit">Нарахувати відсоток</button>
        </form>
    </div>
</body>
</html>
