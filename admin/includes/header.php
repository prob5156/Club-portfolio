<?php
// admin/includes/header.php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dhrupodi</title>
    <link rel="stylesheet" href="/Dhrupodi/admin/assets/css/admin.css">
</head>
<body>
    <!-- Page Transition Loader -->
    <div class="loader-overlay" id="pageLoader">
        <div class="spinner"></div>
    </div>
    
    <!-- Toast Notifications Container -->
    <div class="toast-container" id="toastContainer"></div>

    <?php include_once __DIR__ . '/sidebar.php'; ?>
    <div class="main-wrapper">
        <?php include_once __DIR__ . '/topbar.php'; ?>
        <main class="content-area">
