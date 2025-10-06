<?php
require_once "./ProductClass.php";
require_once "./DiscoundtedProductClass.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["add"] == "product_without_discount" && !isset($_SESSION["session_products"])) {
        $_SESSION["session_products"] = [];
    } elseif ($_POST["add"] == "product_with_discount" && !isset($_SESSION["session_products_discount"])) {
       $_SESSION["session_products_discount"] = [];
    }
    
    if ($_POST["add"] == "product_without_discount") {
        $_SESSION["session_products"][] = new Product(
            $_POST["name"], $_POST["price"], $_POST["description"]);
    } else {
        $_SESSION["session_products_discount"][] = new DiscoundtedProductClass(
            $_POST["name"], $_POST["price"], $_POST["description"], $_POST["discount"]);
    }

    echo "<p>Товар успішно додано!</p>";
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["get_products"] == "0" && (!isset($_SESSION["session_products"]) || 
            empty($_SESSION["session_products"]))) {
        echo "<p>Список продуктів пустий</p>";
        return;
    } elseif ($_GET["get_products"] == "1" && (!isset($_SESSION["session_products_discount"]) || 
                empty($_SESSION["session_products_discount"]))) {
        echo "<p>Список продуктів пустий</p>";
        return;
    }

    $array_name = $_GET["get_products"] == "0" ? $_SESSION["session_products"] : $_SESSION["session_products_discount"];

    for ($i = 0; $i < count($array_name); $i++) { 
        echo "<p>Товар номер ".($i + 1).":</p>";
        echo $array_name[$i]->get_info();
    }
}
