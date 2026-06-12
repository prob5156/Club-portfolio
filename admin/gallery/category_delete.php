<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

if (isset($_GET['id'])) {
    // Delete all images in this category first
    $stmtImages = $pdo->prepare("DELETE FROM gallery_images WHERE category_id = ?");
    $stmtImages->execute([$_GET['id']]);

    // Delete category
    /* Run sql */
    $stmt = $pdo->prepare("DELETE FROM gallery_categories WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Category deleted successfully.'];
}
header('Location: index.php');
exit;
