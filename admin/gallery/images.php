<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$category_id = $_GET['category_id'] ?? 0;
$stmtCat = $pdo->prepare("SELECT * FROM gallery_categories WHERE id = ?");
$stmtCat->execute([$category_id]);
$category = $stmtCat->fetch();

if (!$category) {
    /* Go back */
    header("Location: index.php");
    exit();
}

$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 15;
$offset = ($page - 1) * $perPage;

$search = trim($_GET['search'] ?? '');
$where = "category_id = ?";
$params = [$category_id];

if ($search) {
    $where .= " AND (title LIKE ?)";
    $params[] = "%$search%";
}

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM gallery_images WHERE $where");
$countStmt->execute($params);
$totalItems = $countStmt->fetchColumn();
$totalPages = ceil($totalItems / $perPage);

$query = "SELECT * FROM gallery_images WHERE $where ORDER BY display_order ASC, id DESC LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$items = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<div class="content-area">
    <div style="margin-bottom: 20px;">
        <a href="index.php" class="btn btn-secondary">&larr; Back to Categories</a>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Images in "<?= htmlspecialchars($category['name']) ?>"</h2>
        <a href="image_add.php?category_id=<?= $category['id'] ?>" class="btn btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:middle;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add Image
        </a>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 20px;">
        <form method="GET" action="" style="display: flex; gap: 15px; margin-bottom: 20px;">
            <input type="hidden" name="category_id" value="<?= $category_id ?>">
            <input type="text" name="search" class="form-control" placeholder="Search images..." value="<?= htmlspecialchars($search) ?>" style="flex: 1;">
            <button type="submit" class="btn btn-secondary">Search</button>
            <?php if($search): ?><a href="images.php?category_id=<?= $category_id ?>" class="btn btn-secondary">Clear</a><?php endif; ?>
        </form>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            <?php if (count($items) > 0): ?>
                <?php foreach ($items as $item): ?>
                    <div style="background: rgba(255,255,255,0.05); border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
                        <div style="height: 150px; background: #000; display:flex; align-items:center; justify-content:center;">
                            <?php if ($item['image_path']): ?>
                                <img src="/Dhrupodi/<?= htmlspecialchars($item['image_path']) ?>" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            <?php else: ?>
                                <span style="color:var(--color-text-muted);">No Image</span>
                            <?php endif; ?>
                        </div>
                        <div style="padding: 15px;">
                            <h4 style="margin: 0 0 10px 0; font-size: 1rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($item['title'] ?: 'Untitled') ?></h4>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <?php if ($item['is_published']): ?>
                                    <span style="background: rgba(16,185,129,0.1); color: #10b981; padding: 2px 8px; border-radius: 10px; font-size: 0.75rem;">Published</span>
                                <?php else: ?>
                                    <span style="background: rgba(107,114,128,0.1); color: #6b7280; padding: 2px 8px; border-radius: 10px; font-size: 0.75rem;">Draft</span>
                                <?php endif; ?>
                                <span style="font-size: 0.8rem; color: var(--color-text-muted);">Ord: <?= $item['display_order'] ?></span>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <a href="image_edit.php?id=<?= $item['id'] ?>&category_id=<?= $category_id ?>" class="btn btn-secondary" style="flex: 1; padding: 5px; font-size: 0.8rem; text-align: center;">Edit</a>
                                <a href="image_delete.php?id=<?= $item['id'] ?>&category_id=<?= $category_id ?>" class="btn btn-secondary" style="flex: 1; padding: 5px; font-size: 0.8rem; text-align: center; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);" onclick="return confirm('Delete this image?');">Del</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--color-text-muted);">No images in this category.</div>
            <?php endif; ?>
        </div>

        <?php if ($totalPages > 1): ?>
        <div style="margin-top: 30px; display: flex; justify-content: center; gap: 10px;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?category_id=<?= $category_id ?>&page=<?= $i ?>&search=<?= urlencode($search) ?>" class="btn <?= $i === $page ? 'btn-primary' : 'btn-secondary' ?>" style="padding: 5px 12px;">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
