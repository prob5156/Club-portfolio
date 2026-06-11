<?php
// test_db.php

// Attempt to include the database connection
// Note: If connection fails in config/database.php, it currently exits with a generic message
require_once __DIR__ . '/config/database.php';

try {
    // If the script reaches here, $pdo is successfully instantiated
    echo "<h1>✅ Database Connected Successfully</h1>";

    // Display Database Name
    $dbName = defined('DB_NAME') ? DB_NAME : 'Unknown';
    echo "<p><strong>Database Name:</strong> " . htmlspecialchars($dbName) . "</p>";

    // Display MySQL Version
    $versionStmt = $pdo->query('SELECT VERSION() as version');
    $versionResult = $versionStmt->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>MySQL Version:</strong> " . htmlspecialchars($versionResult['version']) . "</p>";

    // Display Current Time from SQL
    $timeStmt = $pdo->query('SELECT NOW() as current_time_sql');
    $timeResult = $timeStmt->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>Current Time from SQL:</strong> " . htmlspecialchars($timeResult['current_time_sql']) . "</p>";

} catch (PDOException $e) {
    echo "<h1>❌ Database Error Occurred After Connection</h1>";
    echo "<p><strong>Error Details:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
} catch (Exception $e) {
    echo "<h1>❌ General Error</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
