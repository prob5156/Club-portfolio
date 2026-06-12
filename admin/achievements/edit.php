<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM achievements WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    header("Location: index.php");
    exit();
}

$error = '';
// Form validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number_value = trim($_POST['number_value'] ?? '');
    $label = trim($_POST['label'] ?? '');
    $icon_svg = trim($_POST['icon_svg'] ?? '');
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $display_order = (int)($_POST['display_order'] ?? 0);

    if (!$number_value || !$label) {
        $error = "Number Value and Label are required.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE achievements SET number_value = ?, label = ?, icon_svg = ?, display_order = ?, is_active = ? WHERE id = ?");
            $stmt->execute([$number_value, $label, $icon_svg, $display_order, $is_active, $id]);
            $_SESSION['toast'] = ['type' => 'success', 'message' => 'Achievement updated successfully!'];
            header("Location: index.php");
            exit();
        } catch (Exception $e) {
            $error = "Failed to update achievement: " . $e->getMessage();
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Achievements</a>
        <h2>Edit Achievement</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 30px;">
        <?php if($error): ?>
            <div style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Number Value (e.g., "50+", "1M") *</label>
                    <input type="text" name="number_value" class="form-control" value="<?= htmlspecialchars($item['number_value']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Label (e.g., "Awards Won") *</label>
                    <input type="text" name="label" class="form-control" value="<?= htmlspecialchars($item['label']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">SVG Icon Code (Inner path/g tags only)</label>
                    <textarea name="icon_svg" class="form-control" rows="4"><?= htmlspecialchars($item['icon_svg'] ?? '') ?></textarea>
                </div>

                <div style="display: flex; gap: 30px;">
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="is_active" id="is_active" value="1" <?= $item['is_active'] ? 'checked' : '' ?> style="width:18px;height:18px;">
                        <label for="is_active" style="margin:0;cursor:pointer;">Active</label>
                    </div>
                </div>

                <div class="form-group" style="max-width: 200px;">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="<?= htmlspecialchars($item['display_order']) ?>">
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Update Achievement</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
