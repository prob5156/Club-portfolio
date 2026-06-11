<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

// Pagination setup
$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 10;
$offset = ($page - 1) * $perPage;

// Search setup
$search = trim($_GET['search'] ?? '');
$where = "1=1";
$params = [];

if ($search) {
    $where .= " AND (title LIKE ? OR location LIKE ? OR status LIKE ?)";
    $params = ["%$search%", "%$search%", "%$search%"];
}

// Fetch total count
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM events WHERE $where");
$countStmt->execute($params);
$totalEvents = $countStmt->fetchColumn();
$totalPages = ceil($totalEvents / $perPage);

// Fetch records
$query = "SELECT * FROM events WHERE $where ORDER BY event_date DESC, id DESC LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$events = $stmt->fetchAll();
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="content-area">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Manage Events</h2>
        <a href="add.php" class="btn btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:middle;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Event
        </a>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 20px;">
        <form method="GET" action="" style="display: flex; gap: 15px; margin-bottom: 20px;">
            <input type="text" name="search" class="form-control" placeholder="Search events..." value="<?= htmlspecialchars($search) ?>" style="flex: 1;">
            <button type="submit" class="btn btn-secondary">Search</button>
            <?php if($search): ?><a href="index.php" class="btn btn-secondary">Clear</a><?php endif; ?>
        </form>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($events) > 0): ?>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td>
                                    <?php if ($event['image_path']): ?>
                                        <img src="/Dhrupodi/<?= htmlspecialchars($event['image_path']) ?>" alt="Event" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    <?php else: ?>
                                        <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); border-radius: 8px; display:flex; align-items:center; justify-content:center; font-size:10px; color:var(--color-text-muted);">None</div>
                                    <?php endif; ?>
                                </td>
                                <td style="font-weight: 500;"><?= htmlspecialchars($event['title']) ?></td>
                                <td><?= date('M d, Y', strtotime($event['event_date'])) ?> <?= htmlspecialchars($event['event_time']) ?></td>
                                <td><?= htmlspecialchars($event['location'] ?? 'N/A') ?></td>
                                <td>
                                    <?php 
                                        $statusColors = [
                                            'upcoming' => '#3b82f6', 
                                            'ongoing' => '#10b981', 
                                            'completed' => '#6b7280', 
                                            'cancelled' => '#ef4444'
                                        ];
                                        $color = $statusColors[$event['status']] ?? '#3b82f6';
                                    ?>
                                    <span style="background: <?= $color ?>22; color: <?= $color ?>; padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                                        <?= htmlspecialchars($event['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $event['is_featured'] ? '<span style="color:#fbbf24; font-weight:bold;">Yes</span>' : '<span style="color:var(--color-text-muted);">No</span>' ?>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?= $event['id'] ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.9rem;">Edit</a>
                                    <a href="delete.php?id=<?= $event['id'] ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.9rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" style="text-align: center; color: var(--color-text-muted);">No events found.</td></tr>
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
