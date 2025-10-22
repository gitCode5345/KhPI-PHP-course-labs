<?php
session_start();

class CacheManager {
    private static $cache = null;     
    private static $cacheTime = null; 
    private static $cacheLifetime = 10 * 60;

    public static function getData() {
        $now = time();

        if (self::$cache !== null && self::$cacheTime !== null && ($now - self::$cacheTime) <= self::$cacheLifetime) {
            return self::$cache;
        }

        if (isset($_SESSION['cached_data'], $_SESSION['cached_time']) && ($now - $_SESSION['cached_time']) <= self::$cacheLifetime) {
            self::$cache = $_SESSION['cached_data'];
            self::$cacheTime = $_SESSION['cached_time'];
            return self::$cache;
        }

        echo "<p><em>Формується новий кеш...</em></p>";
        sleep(2);

        self::$cache = [
            'users' => rand(100, 200),
            'sales' => rand(50, 100),
            'profit' => rand(10_000, 50_000)
        ];

        self::$cacheTime = $now;

        $_SESSION['cached_data'] = self::$cache;
        $_SESSION['cached_time'] = self::$cacheTime;

        return self::$cache;
    }

    public static function getCacheTime() {
        return self::$cacheTime;
    }
}
