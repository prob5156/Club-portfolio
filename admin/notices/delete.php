<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM notices WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Notice deleted successfully.'];
}
header('Location: index.php');
exit;
