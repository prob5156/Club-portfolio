<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM notices WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    header("Location: index.php");
    exit();
}

$error = '';
/* Validate form input */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $display_order = (int)($_POST['display_order'] ?? 0);

    if (!$title || !$content) {
        $error = "Title and content are required.";
    } else {
        $attachment_path = $item['attachment_path'];

        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['attachment']['tmp_name'];
            $fileSize = $_FILES['attachment']['size'];
            
            if ($fileSize > 10 * 1024 * 1024) {
                $error = "Attachment size must be less than 10 MB.";
            } else {
                $uploadDir = __DIR__ . '/../../uploads/notices/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $extension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
                if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                    $attachment_path = 'uploads/notices/' . $filename;
                } else {
                    $error = "Failed to save the attachment.";
                }
            }
        }

        if (!$error) {
            try {
                $stmt = $pdo->prepare("UPDATE notices SET title = ?, content = ?, attachment_path = ?, is_featured = ?, is_published = ?, display_order = ? WHERE id = ?");
                $stmt->execute([$title, $content, $attachment_path, $is_featured, $is_published, $display_order, $id]);
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Notice updated successfully!'];
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $error = "Failed to update notice: " . $e->getMessage();
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Notices</a>
        <h2>Edit Notice</h2>
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
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($item['title']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Content *</label>
                    <textarea name="content" class="form-control" rows="8" required><?= htmlspecialchars($item['content']) ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Attachment (PDF, Word, Images, etc. - Max 10MB)</label>
                    <?php if ($item['attachment_path']): ?>
                        <div style="margin-bottom: 10px;">Current: <a href="/Dhrupodi/<?= htmlspecialchars($item['attachment_path']) ?>" target="_blank" style="color: #3b82f6;">View File</a></div>
                    <?php endif; ?>
                    <input type="file" name="attachment" class="form-control">
                </div>

                <div style="display: flex; gap: 30px;">
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="is_published" id="is_published" value="1" <?= $item['is_published'] ? 'checked' : '' ?> style="width:18px;height:18px;">
                        <label for="is_published" style="margin:0;cursor:pointer;">Published</label>
                    </div>
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" <?= $item['is_featured'] ? 'checked' : '' ?> style="width:18px;height:18px;">
                        <label for="is_featured" style="margin:0;cursor:pointer;">Featured</label>
                    </div>
                </div>

                <div class="form-group" style="max-width: 200px;">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="<?= htmlspecialchars($item['display_order']) ?>">
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Update Notice</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
