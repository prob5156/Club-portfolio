<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM gallery_categories WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    /* Go back */
    header("Location: index.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $display_order = (int)($_POST['display_order'] ?? 0);

    if (!$name) {
        $error = "Category Name is required.";
    } else {
        $cover_image_path = $item['cover_image_path'];

        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['cover_image']['tmp_name'];
            $fileSize = $_FILES['cover_image']['size'];
            
            if ($fileSize > 5 * 1024 * 1024) {
                $error = "Image size must be less than 5 MB.";
            } else {
                $uploadDir = __DIR__ . '/../../uploads/gallery/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $extension = pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
                if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                    $cover_image_path = 'uploads/gallery/' . $filename;
                } else {
                    $error = "Failed to save the image.";
                }
            }
        }

        if (!$error) {
            try {
                $stmt = $pdo->prepare("UPDATE gallery_categories SET name = ?, description = ?, cover_image_path = ?, is_active = ?, display_order = ? WHERE id = ?");
                $stmt->execute([$name, $description, $cover_image_path, $is_active, $display_order, $id]);
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Category updated successfully!'];
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $error = "Failed to update category: " . $e->getMessage();
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Categories</a>
        <h2>Edit Category</h2>
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
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($item['name']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Cover Image (Max 5MB)</label>
                    <?php if ($item['cover_image_path']): ?>
                        <div style="margin-bottom: 10px;">
                            <img src="/Dhrupodi/<?= htmlspecialchars($item['cover_image_path']) ?>" style="height: 100px; border-radius: 4px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
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
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Update Category</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
