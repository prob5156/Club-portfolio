<?php
// logout.php
require_once __DIR__ . '/config/session.php';
// Invalidate Remember Me token if present
if (isset($_COOKIE['remember_me'])) {
    $cookieParts = explode(':', $_COOKIE['remember_me']);
    if (count($cookieParts) === 2) {
        $selector = $cookieParts[0];
        require_once __DIR__ . '/config/database.php';
        $stmt = $pdo->prepare("DELETE FROM user_tokens WHERE selector = ?");
        $stmt->execute([$selector]);
    }
    setcookie('remember_me', '', time() - 3600, '/');
}

session_destroy();
header("Location: /Dhrupodi/");
exit();
