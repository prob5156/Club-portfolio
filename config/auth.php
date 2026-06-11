<?php
// config/auth.php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/database.php';

// Handle Auto-login
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $cookieParts = explode(':', $_COOKIE['remember_me']);
    if (count($cookieParts) === 2) {
        list($selector, $validator) = $cookieParts;
        
        $stmt = $pdo->prepare("
            SELECT ut.validator_hash, u.id AS user_id, u.role 
            FROM user_tokens ut 
            JOIN users u ON ut.user_id = u.id 
            WHERE ut.selector = ? AND ut.expires_at >= NOW() AND u.is_active = 1
        ");
        $stmt->execute([$selector]);
        $tokenRecord = $stmt->fetch();
        
        if ($tokenRecord && hash_equals($tokenRecord['validator_hash'], hash('sha256', $validator))) {
            $_SESSION['user_id'] = $tokenRecord['user_id'];
            $_SESSION['role'] = $tokenRecord['role'];
            
            if ($tokenRecord['role'] === 'admin') {
                header("Location: /Dhrupodi/admin/index.php");
            } else {
                header("Location: /Dhrupodi/member/index.php");
            }
            exit();
        } else {
            // Invalid or expired cookie
            setcookie('remember_me', '', time() - 3600, '/');
        }
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserRole() {
    return $_SESSION['role'] ?? null;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /Dhrupodi/login.php");
        exit();
    }
}

function requireAdmin() {
    requireLogin();
    $role = getUserRole();
    if ($role !== 'admin') {
        header("Location: /Dhrupodi/member/index.php");
        exit();
    }
}

function requireMember() {
    requireLogin();
    $role = getUserRole();
    // Allow only members
    if ($role !== 'member') {
        header("Location: /Dhrupodi/admin/index.php");
        exit();
    }
}
