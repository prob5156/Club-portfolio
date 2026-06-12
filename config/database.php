<?php
// config/database.php
require_once __DIR__ . '/env.php';

try {
    /* Connect to database */
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    // create pdo instance
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // catch db error
    error_log("Database Connection Error: " . $e->getMessage());
    exit("A database connection error occurred. Please try again later.");
}
