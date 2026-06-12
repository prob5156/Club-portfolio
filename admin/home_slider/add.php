<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $subtitle = trim($_POST['subtitle'] ?? '');
    $button_text = trim($_POST['button_text'] ?? '');
    $button_link = trim($_POST['button_link'] ?? '');
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $display_order = (int)($_POST['display_order'] ?? 0);

    if (!$title) {
        $error = "Title is required.";
    } else {
        $image_path = '';

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            
            if ($fileSize > 5 * 1024 * 1024) {
                $error = "Image size must be less than 5 MB.";
            } else {
                $uploadDir = __DIR__ . '/../../uploads/slider/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
                if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                    $image_path = 'uploads/slider/' . $filename;
                } else {
                    $error = "Failed to save the image.";
                }
            }
        } else {
            $error = "Background image is required.";
        }

        if (!$error) {
            try {
                // execute query
                $stmt = $pdo->prepare("INSERT INTO home_slider (title, subtitle, button_text, button_link, image_path, display_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$title, $subtitle, $button_text, $button_link, $image_path, $display_order, $is_active]);
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Slide added successfully!'];
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $error = "Failed to add slide: " . $e->getMessage();
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Slider</a>
        <h2>Add New Slide</h2>
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
                    <label class="form-label">Title (Can contain HTML) *</label>
                    <textarea name="title" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Subtitle (Can contain HTML)</label>
                    <textarea name="subtitle" class="form-control" rows="2"></textarea>
                </div>

                <div style="display: flex; gap: 20px;">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="button_text" class="form-control" placeholder="e.g. Join Us Today">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Button Link</label>
                        <input type="text" name="button_link" class="form-control" placeholder="e.g. /Dhrupodi/signup.php">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Background Image * (Max 5MB)</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
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
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Save Slide</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
