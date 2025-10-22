<?php
require_once './CacheManager.php';

$data1 = CacheManager::getData();
$data2 = CacheManager::getData();

echo "<h2>Кеш через статичну властивість класу</h2>";

foreach ($data2 as $k => $v) {
    echo "<p>$k : $v</p>";
}

echo "<p><small>Останнє оновлення кешу: " . date("H:i:s", CacheManager::getCacheTime()) . " GMT</small></p>";
