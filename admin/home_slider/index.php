<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 10;
$offset = ($page - 1) * $perPage;

$search = trim($_GET['search'] ?? '');
$where = "1=1";
$params = [];

if ($search) {
    $where .= " AND (title LIKE ? OR subtitle LIKE ?)";
    $params = ["%$search%", "%$search%"];
}

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM home_slider WHERE $where");
$countStmt->execute($params);
$totalItems = $countStmt->fetchColumn();
$totalPages = ceil($totalItems / $perPage);

$query = "SELECT * FROM home_slider WHERE $where ORDER BY display_order ASC, id DESC LIMIT $perPage OFFSET $offset";
/* Fetch data */
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$items = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<div class="content-area">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Manage Home Slider</h2>
        <a href="add.php" class="btn btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:middle;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Slide
        </a>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 20px;">
        <form method="GET" action="" style="display: flex; gap: 15px; margin-bottom: 20px;">
            <input type="text" name="search" class="form-control" placeholder="Search slides..." value="<?= htmlspecialchars($search) ?>" style="flex: 1;">
            <button type="submit" class="btn btn-secondary">Search</button>
            <?php if($search): ?><a href="index.php" class="btn btn-secondary">Clear</a><?php endif; ?>
        </form>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($items) > 0): ?>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <?php if ($item['image_path']): ?>
                                        <img src="/Dhrupodi/<?= htmlspecialchars($item['image_path']) ?>" alt="Slide" style="width: 100px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">
                                    <?php else: ?>
                                        <div style="width: 100px; height: 50px; background: rgba(255,255,255,0.1); border-radius: 4px; display:flex; align-items:center; justify-content:center; font-size:10px; color:var(--color-text-muted);">None</div>
                                    <?php endif; ?>
                                </td>
                                <td style="font-weight: 500;"><?= htmlspecialchars($item['title']) ?></td>
                                <td><?= htmlspecialchars($item['subtitle']) ?></td>
                                <td><?= htmlspecialchars($item['display_order']) ?></td>
                                <td>
                                    <?php if ($item['is_active']): ?>
                                        <span style="background: rgba(16,185,129,0.1); color: #10b981; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Active</span>
                                    <?php else: ?>
                                        <span style="background: rgba(107,114,128,0.1); color: #6b7280; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?= $item['id'] ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.9rem;">Edit</a>
                                    <a href="delete.php?id=<?= $item['id'] ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.9rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);" onclick="return confirm('Are you sure you want to delete this slide?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; color: var(--color-text-muted);">No slides found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalPages > 1): ?>
        <div style="margin-top: 20px; display: flex; justify-content: center; gap: 10px;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" class="btn <?= $i === $page ? 'btn-primary' : 'btn-secondary' ?>" style="padding: 5px 12px;">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
