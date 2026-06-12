<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$category_id = $_GET['category_id'] ?? 0;

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM gallery_images WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Image deleted successfully.'];
}
header("Location: images.php?category_id=$category_id");
exit;
