<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$search = $_GET['search'] ?? '';

$query = "SELECT m.*, u.email FROM members m JOIN users u ON m.user_id = u.id";
$params = [];

if ($search) {
    $query .= " WHERE m.name LIKE ? OR m.role_title LIKE ? OR m.department LIKE ? OR u.email LIKE ?";
    $searchTerm = "%$search%";
    $params = [$searchTerm, $searchTerm, $searchTerm, $searchTerm];
}

$query .= " ORDER BY m.display_order ASC, m.name ASC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$members = $stmt->fetchAll();
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Manage Members</h2>
        <a href="add.php" class="btn btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add Member
        </a>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 25px;">
        <form method="GET" action="" style="display: flex; gap: 15px; margin-bottom: 20px;">
            <input type="text" name="search" class="form-control" placeholder="Search by name, role, dept or email..." value="<?= htmlspecialchars($search) ?>" style="max-width: 400px;">
            <button type="submit" class="btn btn-secondary">Search</button>
            <?php if($search): ?>
                <a href="index.php" class="btn btn-danger">Clear</a>
            <?php endif; ?>
        </form>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($members as $member): ?>
                    <tr>
                        <td>
                            <?php if($member['image_path']): ?>
                                <img src="/Dhrupodi/<?= htmlspecialchars($member['image_path']) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                            <?php else: ?>
                                <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);">NA</div>
                            <?php endif; ?>
                        </td>
                        <td style="font-weight: 600; color: #fff;">
                            <?= htmlspecialchars($member['name']) ?><br>
                            <span style="font-size: 0.8rem; font-weight: normal; color: var(--color-text-muted);"><?= htmlspecialchars($member['email']) ?></span>
                        </td>
                        <td><?= htmlspecialchars($member['role_title'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($member['department'] ?? '-') ?></td>
                        <td>
                            <?php
                            $statusColors = [
                                'active' => 'var(--color-success)',
                                'alumni' => 'var(--color-info)',
                                'hidden' => 'var(--color-text-muted)'
                            ];
                            $color = $statusColors[$member['status']] ?? '#fff';
                            ?>
                            <span style="background: <?= $color ?>; color: #fff; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase;">
                                <?= htmlspecialchars($member['status']) ?>
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="edit.php?id=<?= $member['id'] ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.85rem;">Edit</a>
                                <a href="delete.php?id=<?= $member['id'] ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.85rem;" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($members)): ?>
                    <tr><td colspan="6" style="text-align: center; padding: 40px; color: var(--color-text-muted);">No members found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
// Toasts display
if(isset($_SESSION['toast'])):
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if(window.Toast) {
        window.Toast.show("<?= addslashes($_SESSION['toast']['message']) ?>", "<?= addslashes($_SESSION['toast']['type']) ?>");
    }
});
</script>
<?php
unset($_SESSION['toast']);
endif;
?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
