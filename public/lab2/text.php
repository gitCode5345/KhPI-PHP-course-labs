<?php
$log_file = "./uploads/log.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text_field"];

    if (isset($text)) {
        file_put_contents($log_file, $text.PHP_EOL, FILE_APPEND);
        echo "<p>Content saved</p>";
    } else {
        echo "<p>An error occurred.</p>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (file_exists($log_file)) {
        $saved_data = file_get_contents($log_file);
        echo "<p>All saved data:</p> <br>".$saved_data;
    } else {
        echo "<p>the file has not been created yet, please save some information</p><br>"; 
    }
}
