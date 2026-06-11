<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $stmt = $pdo->prepare("SELECT image_path FROM events WHERE id = ?");
    $stmt->execute([$id]);
    $event = $stmt->fetch();

    if ($event) {
        if ($event['image_path'] && file_exists(__DIR__ . '/../../' . $event['image_path'])) {
            unlink(__DIR__ . '/../../' . $event['image_path']);
        }
        
        $delStmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $delStmt->execute([$id]);
        
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Event deleted successfully!'];
    }
}

header("Location: index.php");
exit();
