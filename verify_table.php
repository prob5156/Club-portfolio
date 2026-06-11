<?php
require_once __DIR__ . '/config/database.php';
$stmt = $pdo->query("SHOW TABLES LIKE 'user_tokens'");
print_r($stmt->fetchAll());
