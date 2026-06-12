<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ?");
$stmt->execute([$id]);
$msg = $stmt->fetch();

if (!$msg) {
    header("Location: index.php");
    exit();
}

// Mark as read if it's currently unread
if ($msg['status'] === 'unread') {
    $pdo->prepare("UPDATE contact_messages SET status = 'read' WHERE id = ?")->execute([$id]);
    $msg['status'] = 'read';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'] ?? 'read';
    $admin_notes = $_POST['admin_notes'] ?? '';
    
    $updateStmt = $pdo->prepare("UPDATE contact_messages SET status = ?, admin_notes = ? WHERE id = ?");
    $updateStmt->execute([$status, $admin_notes, $id]);
    
    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Message updated successfully.'];
    header("Location: view.php?id=$id");
    exit();
}

require_once __DIR__ . '/../includes/header.php';
?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Messages</a>
        <h2>View Message</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 30px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
            <div><strong>From:</strong> <?= htmlspecialchars($msg['name']) ?></div>
            <div><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($msg['email']) ?>"><?= htmlspecialchars($msg['email']) ?></a></div>
            <div><strong>Date:</strong> <?= date('F j, Y, g:i a', strtotime($msg['created_at'])) ?></div>
            <div><strong>Subject:</strong> <?= htmlspecialchars($msg['subject']) ?></div>
        </div>
        
        <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px; margin-bottom: 30px; white-space: pre-wrap; font-family: inherit; line-height: 1.6; border: 1px solid rgba(255,255,255,0.1);"><?= htmlspecialchars($msg['message']) ?></div>
        
        <hr style="border: none; border-top: 1px solid rgba(255,255,255,0.1); margin-bottom: 30px;">
        
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" style="max-width: 300px;">
                    <option value="read" <?= $msg['status'] === 'read' ? 'selected' : '' ?>>Read</option>
                    <option value="replied" <?= $msg['status'] === 'replied' ? 'selected' : '' ?>>Replied</option>
                    <option value="unread" <?= $msg['status'] === 'unread' ? 'selected' : '' ?>>Unread</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Admin Notes</label>
                <textarea name="admin_notes" class="form-control" rows="4" placeholder="Private notes for admins only..."><?= htmlspecialchars($msg['admin_notes'] ?? '') ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Save Updates</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
