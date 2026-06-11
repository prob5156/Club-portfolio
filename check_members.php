<?php
require_once __DIR__ . '/config/database.php';
$stmt = $pdo->query('SHOW CREATE TABLE members');
print_r($stmt->fetch());
