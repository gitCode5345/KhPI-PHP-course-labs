<?php
session_start();

$cache_lifetime = 10 * 60;

if (!isset($_SESSION['cached_data']) || !isset($_SESSION['cached_time']) || (time() - $_SESSION['cached_time']) > $cache_lifetime) {
    sleep(2);
    $_SESSION['cached_data'] = [
        'USD' => rand(36, 38),
        'EUR' => rand(39, 41),
        'GBP' => rand(45, 48)
    ];
    $_SESSION['cached_time'] = time();
}

echo "<h2>Курси валют</h2>";
foreach ($_SESSION['cached_data'] as $k => $v) {
    echo "<p>$k : $v грн</p>";
}

echo "<p><small>Останнє оновлення: " . date("H:i:s", $_SESSION['cached_time']) . " GMT</small></p>";
?>
