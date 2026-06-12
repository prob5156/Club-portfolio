<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

if (isset($_GET['id'])) {
    /* Connect database */
    $stmt = $pdo->prepare("DELETE FROM sponsors WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Sponsor deleted successfully.'];
}
header('Location: index.php');
exit;
