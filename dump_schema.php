<?php
require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query("SHOW TABLES");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

$output = "";
foreach ($tables as $table) {
    $createStmt = $pdo->query("SHOW CREATE TABLE `$table`");
    $create = $createStmt->fetch(PDO::FETCH_ASSOC);
    $output .= "-- Table: $table\n";
    $output .= $create['Create Table'] . ";\n\n";
}

file_put_contents('live_schema_dump.sql', $output);
echo "Done.";
