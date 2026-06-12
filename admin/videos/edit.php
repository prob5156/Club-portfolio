<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    /* Page redirect */
    header("Location: index.php");
    exit();
}

$error = '';
/* Handle form submission */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $video_url = trim($_POST['video_url'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $display_order = (int)($_POST['display_order'] ?? 0);

    if (strpos($video_url, 'youtube.com/watch?v=') !== false) {
        parse_str(parse_url($video_url, PHP_URL_QUERY), $vars);
        if (isset($vars['v'])) {
            $video_url = "https://www.youtube.com/embed/" . $vars['v'];
        }
    } elseif (strpos($video_url, 'youtu.be/') !== false) {
        $path = parse_url($video_url, PHP_URL_PATH);
        $video_url = "https://www.youtube.com/embed" . $path;
    }

    if (!$title || !$video_url) {
        $error = "Title and video URL are required.";
    } else {
        $thumbnail_path = $item['thumbnail_path'];

        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['thumbnail']['tmp_name'];
            $fileSize = $_FILES['thumbnail']['size'];
            
            if ($fileSize > 5 * 1024 * 1024) {
                $error = "Thumbnail size must be less than 5 MB.";
            } else {
                $uploadDir = __DIR__ . '/../../uploads/videos/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
                if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                    $thumbnail_path = 'uploads/videos/' . $filename;
                } else {
                    $error = "Failed to save the thumbnail.";
                }
            }
        }

        if (!$error) {
            try {
                $stmt = $pdo->prepare("UPDATE videos SET title = ?, video_url = ?, thumbnail_path = ?, description = ?, is_featured = ?, is_published = ?, display_order = ? WHERE id = ?");
                $stmt->execute([$title, $video_url, $thumbnail_path, $description, $is_featured, $is_published, $display_order, $id]);
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Video updated successfully!'];
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $error = "Failed to update video: " . $e->getMessage();
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Videos</a>
        <h2>Edit Video</h2>
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
                    <label class="form-label">Video URL (YouTube link) *</label>
                    <input type="url" name="video_url" class="form-control" value="<?= htmlspecialchars($item['video_url']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Thumbnail Image (Max 5MB)</label>
                    <?php if ($item['thumbnail_path']): ?>
                        <div style="margin-bottom: 10px;">
                            <img src="/Dhrupodi/<?= htmlspecialchars($item['thumbnail_path']) ?>" style="height: 100px; border-radius: 5px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
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
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Update Video</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
