<?php
require_once "./CategoryClass.php";
require_once "./ProductClass.php";
require_once "./DiscoundtedProductClass.php";

session_start();

if (!isset($_SESSION["categories"])) {
    $_SESSION["categories"] = [];
}

if (!isset($_SESSION["session_products"])) {
    $_SESSION["session_products"] = [];
}
if (!isset($_SESSION["session_products_discount"])) {
    $_SESSION["session_products_discount"] = [];
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_category'])) {
    $category_name = trim($_POST['category_name'] ?? '');
    if ($category_name !== '') {
        $exists = false;
        foreach ($_SESSION["categories"] as $cat) {
            if ($cat->category_name === $category_name) {
                $exists = true;
                break;
            }
        }
        if (!$exists) {
            $_SESSION["categories"][] = new Category($category_name);
            $message = "Категорія '$category_name' успішно додана";
        } else {
            $message = "Категорія з такою назвою вже існує";
        }
    } else {
        $message = "Назва категорії не може бути порожньою";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['assign_product'])) {
    $category_name = $_POST['assign_category'] ?? '';
    $product_name = $_POST['assign_product_name'] ?? '';

    if ($category_name !== '' && $product_name !== '') {
        foreach ($_SESSION["categories"] as $index => $category) {
            if ($category->category_name === $category_name) {
                $all_products = array_merge($_SESSION["session_products"], $_SESSION["session_products_discount"]);
                foreach ($all_products as $prod) {
                    if ($prod->name === $product_name) {
                        $_SESSION["categories"][$index]->add_product_to_category($prod);
                        $message = "Товар '$product_name' додано до категорії '$category_name'";
                        break 2;
                    }
                }
            }
        }
    }
}


$categories_output = Category::render_all_categories($_SESSION["categories"]);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Категорії товарів</title>
</head>
<body>

<h1>Категорії товарів</h1>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<hr>

<h2>Додати нову категорію</h2>
<form method="POST" action="">
    <input type="hidden" name="add_category" value="1">
    <label>Нова категорія:</label><br>
    <input type="text" name="category_name" required>
    <button type="submit">Додати</button>
</form>

<hr>

<h2>Прив'язати товар до категорії</h2>
<form method="POST" action="">
    <input type="hidden" name="assign_product" value="1">

    <label>Категорія:</label><br>
    <select name="assign_category" required>
        <?php foreach ($_SESSION["categories"] as $cat): ?>
            <option value="<?php echo htmlspecialchars($cat->category_name); ?>">
                <?php echo htmlspecialchars($cat->category_name); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Товар:</label><br>
    <select name="assign_product_name" required>
        <?php
        $all_products = array_merge($_SESSION["session_products"], $_SESSION["session_products_discount"]);
        foreach ($all_products as $prod):
            echo "<option value='".htmlspecialchars($prod->name)."'>".htmlspecialchars($prod->name)."</option>";
        endforeach;
        ?>
    </select><br><br>

    <button type="submit">Прив'язати</button>
</form>

<hr>

<!-- Вивід усіх категорій -->
<h2>Список категорій з товарами</h2>
<?php echo $categories_output; ?>

</body>
</html>
