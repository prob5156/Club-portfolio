<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$error = '';
// Form validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $website_url = trim($_POST['website_url'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $display_order = (int)($_POST['display_order'] ?? 0);

    if (!$name) {
        $error = "Name is required.";
    } else {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-')) . '-' . time();
        $logo_path = '';

        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['logo']['tmp_name'];
            $fileSize = $_FILES['logo']['size'];
            
            if ($fileSize > 5 * 1024 * 1024) {
                $error = "Logo size must be less than 5 MB.";
            } else {
                $uploadDir = __DIR__ . '/../../uploads/sponsors/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
                if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                    $logo_path = 'uploads/sponsors/' . $filename;
                } else {
                    $error = "Failed to save the logo.";
                }
            }
        } else {
            $error = "Logo image is required.";
        }

        if (!$error) {
            try {
                $stmt = $pdo->prepare("INSERT INTO sponsors (name, slug, logo_path, website_url, description, display_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $slug, $logo_path, $website_url, $description, $display_order, $is_active]);
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Sponsor added successfully!'];
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $error = "Failed to add sponsor: " . $e->getMessage();
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Sponsors</a>
        <h2>Add New Sponsor</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 30px;">
        <?php if($error): ?>
            <div style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Sponsor Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Website URL</label>
                    <input type="url" name="website_url" class="form-control" placeholder="https://...">
                </div>

                <div class="form-group">
                    <label class="form-label">Logo Image * (Max 5MB)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <div style="display: flex; gap: 30px;">
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked style="width:18px;height:18px;">
                        <label for="is_active" style="margin:0;cursor:pointer;">Active</label>
                    </div>
                </div>

                <div class="form-group" style="max-width: 200px;">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="0">
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Save Sponsor</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
