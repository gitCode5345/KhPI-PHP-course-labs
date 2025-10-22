<?php
$cache_dir = __DIR__ . '/cache';
$cache_file = $cache_dir . '/report.html';
$cache_time = 600;

if (!is_dir($cache_dir)) {
    mkdir($cache_dir, 0777, true);
}

if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_time) {
    echo file_get_contents($cache_file);
    exit;
}

sleep(3);

$data = "<h2>Звіт з випадковими даними</h2><table border='1'>";
for ($i = 0; $i < 1000; $i++) {
    $data .= "<tr><td>Ім'я $i</td><td>" . rand(100, 999) . "</td><td>" . date('Y-m-d') . "</td></tr>";
}
$data .= "</table>";

file_put_contents($cache_file, $data);

echo $data;
