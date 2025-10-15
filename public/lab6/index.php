<?php
session_start();

$servername_db = "mysql";
$username_db = getenv("MYSQL_USER");
$password_db = getenv("MYSQL_PASSWORD");
$namedb   = getenv("MYSQL_DB");

if (isset($_SESSION["user_session_username"])) {
    header("Location: welcome.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = mysqli_connect($servername_db, $username_db, $password_db, $namedb);

        if (!$conn) {
            die("Помилка підключення: " . mysqli_connect_error());
        }

        if (isset($_POST["registration"]) && !check_user_for_registation($_POST["email"], $conn)) {
            if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                echo "Перевірьте введені дані, поля не можуть бути пустими";
                return;
            }

            $hash_password = md5($_POST['password']);

            $register_user_prepare = mysqli_prepare(
                $conn,
                "INSERT INTO users(username, email, password) VALUES(?, ?, ?)"
            );

            mysqli_stmt_bind_param($register_user_prepare, "sss",  $_POST['username'], $_POST['email'], $hash_password);
            mysqli_stmt_execute($register_user_prepare);

            echo "Користувача додано!";
            return;
        } elseif (isset($_POST["login"])) {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                echo "Перевірьте введені дані, поля не можуть бути пустими";
                return;
            }
            if (login_user($_POST["username"], $_POST["password"], $conn)) {
                echo "Ви успішно авторизовані. Привіт, ".$_POST["username"]."!";
                $_SESSION["user_session_username"] = $_POST["username"];
                header("Location: welcome.php");
                exit();
            } else {
                echo "Невірний логін або пароль";
            }
        }
    } catch (Exception $th) {
        echo "Сталася помилка: ". $th->getMessage();
        return false;
    } finally {
        mysqli_close($conn);
    }
}

function check_user_for_registation(string $email, $mysql_conn) {
    $check_user_prepare = mysqli_prepare($mysql_conn,
        "SELECT email FROM users WHERE email = ?");
    
    mysqli_stmt_bind_param($check_user_prepare, "s", $email);
    mysqli_stmt_execute($check_user_prepare);
    
    mysqli_stmt_store_result($check_user_prepare);
    $num_rows = mysqli_stmt_num_rows($check_user_prepare);
    
    if ($num_rows > 0) {
        echo "Такий аккаунт вже зареєстровано.";
        return true;
    } else {
        return false;
    }
}

function login_user(string $username, string $pass, $mysql_conn) {
    $stmt = mysqli_prepare($mysql_conn,
        "SELECT password FROM users WHERE username = ?");
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $user_password);

    if (mysqli_stmt_fetch($stmt)) {
        if (md5($pass) === $user_password) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
