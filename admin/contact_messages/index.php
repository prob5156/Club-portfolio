<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 15;
$offset = ($page - 1) * $perPage;

$countStmt = $pdo->query("SELECT COUNT(*) FROM contact_messages");
$totalItems = $countStmt->fetchColumn();
$totalPages = ceil($totalItems / $perPage);

$stmt = $pdo->prepare("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$stmt->execute();
$items = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="content-area">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Contact Messages</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 20px;">
        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($items) > 0): ?>
                        <?php foreach ($items as $item): ?>
                            <tr style="<?= $item['status'] === 'unread' ? 'font-weight: bold; background: rgba(59,130,246,0.05);' : '' ?>">
                                <td><?= date('M d, Y h:i A', strtotime($item['created_at'])) ?></td>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><a href="mailto:<?= htmlspecialchars($item['email']) ?>"><?= htmlspecialchars($item['email']) ?></a></td>
                                <td><?= htmlspecialchars($item['subject']) ?></td>
                                <td>
                                    <?php 
                                        $colors = ['unread' => '#ef4444', 'read' => '#3b82f6', 'replied' => '#10b981'];
                                        $color = $colors[$item['status']] ?? '#6b7280';
                                    ?>
                                    <span style="background: <?= $color ?>22; color: <?= $color ?>; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                                        <?= htmlspecialchars($item['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="view.php?id=<?= $item['id'] ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.9rem;">View</a>
                                    <a href="delete.php?id=<?= $item['id'] ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.9rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);" onclick="return confirm('Delete this message?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; color: var(--color-text-muted);">No messages found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($totalPages > 1): ?>
        <div style="margin-top: 20px; display: flex; justify-content: center; gap: 10px;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="btn <?= $i === $page ? 'btn-primary' : 'btn-secondary' ?>" style="padding: 5px 12px;">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
