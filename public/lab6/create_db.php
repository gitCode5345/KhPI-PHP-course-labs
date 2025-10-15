<?php
$servername_db = "mysql";
$username_db = getenv("MYSQL_USER");
$password_db = getenv("MYSQL_PASSWORD");
$namedb = getenv("MYSQL_DB");

$conn = mysqli_connect($servername_db, $username_db, $password_db, $namedb);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected to DB: $namedb<br>";

$sql_create_table = "
    CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
)";
if (mysqli_query($conn, $sql_create_table)) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
