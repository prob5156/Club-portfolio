<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $stmt = $pdo->prepare("SELECT user_id, image_path FROM members WHERE id = ?");
    $stmt->execute([$id]);
    $member = $stmt->fetch();

    if ($member) {
        // Delete image safely if it exists
        if ($member['image_path'] && file_exists(__DIR__ . '/../../' . $member['image_path'])) {
            unlink(__DIR__ . '/../../' . $member['image_path']);
        }

        // Delete from users (cascade deletes member due to ON DELETE CASCADE)
        try {
            $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$member['user_id']]);
            $_SESSION['toast'] = ['type' => 'success', 'message' => 'Member deleted successfully.'];
        } catch (Exception $e) {
            $_SESSION['toast'] = ['type' => 'error', 'message' => 'Failed to delete member.'];
        }
    }
}

header("Location: index.php");
exit();
