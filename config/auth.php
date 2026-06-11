<?php
// config/auth.php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/database.php';

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
