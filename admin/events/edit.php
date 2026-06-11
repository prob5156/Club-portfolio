<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    header("Location: index.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $event_date = trim($_POST['event_date'] ?? '');
    $event_time = trim($_POST['event_time'] ?? '') ?: null;
    $end_date = trim($_POST['end_date'] ?? '') ?: null;
    $end_time = trim($_POST['end_time'] ?? '') ?: null;
    $location = trim($_POST['location'] ?? '') ?: null;
    $description = trim($_POST['description'] ?? '') ?: null;
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $status = $_POST['status'] ?? 'upcoming';
    $display_order = (int)($_POST['display_order'] ?? 0);

    if (!$title || !$event_date) {
        $error = "Title and Event Date are required.";
    } else {
        $image_path = $event['image_path'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            
            if ($fileSize > 5 * 1024 * 1024) {
                $error = "Image size must be less than 5 MB.";
            } else {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $fileTmp);
                finfo_close($finfo);
                
                $allowedMimes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
                if (!array_key_exists($mimeType, $allowedMimes)) {
                    $error = "Only JPG, PNG, and WEBP images are allowed.";
                } else {
                    $extension = $allowedMimes[$mimeType];
                    $uploadDir = __DIR__ . '/../../uploads/events/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                    
                    $filename = bin2hex(random_bytes(16)) . '.' . $extension;
                    if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                        if ($image_path && file_exists(__DIR__ . '/../../' . $image_path)) {
                            unlink(__DIR__ . '/../../' . $image_path);
                        }
                        $image_path = 'uploads/events/' . $filename;
                    } else {
                        $error = "Failed to upload image.";
                    }
                }
            }
        }

        if (!$error) {
            try {
                $stmt = $pdo->prepare("
                    UPDATE events SET 
                    title = ?, event_date = ?, event_time = ?, end_date = ?, end_time = ?, 
                    location = ?, description = ?, image_path = ?, is_featured = ?, is_published = ?, 
                    status = ?, display_order = ?
                    WHERE id = ?
                ");
                $stmt->execute([
                    $title, $event_date, $event_time, $end_date, $end_time, 
                    $location, $description, $image_path, $is_featured, $is_published, 
                    $status, $display_order, $id
                ]);

                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Event updated successfully!'];
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $error = "Failed to update event: " . $e->getMessage();
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Events</a>
        <h2>Edit Event: <?= htmlspecialchars($event['title']) ?></h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 30px;">
        <?php if($error): ?>
            <div style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                
                <div class="form-group" style="grid-column: 1 / -1; display: flex; align-items: center; gap: 20px;">
                    <?php if($event['image_path']): ?>
                        <img src="/Dhrupodi/<?= htmlspecialchars($event['image_path']) ?>" alt="" style="width: 150px; height: 100px; object-fit: cover; border-radius: 12px; border: 2px solid var(--glass-border);">
                    <?php else: ?>
                        <div style="width: 150px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);">No Image</div>
                    <?php endif; ?>
                    <div>
                        <label class="form-label">Update Cover Image (Max 5MB)</label>
                        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Event Title *</label>
                    <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($event['title']) ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Start Date *</label>
                    <input type="date" name="event_date" class="form-control" required value="<?= htmlspecialchars($event['event_date']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="event_time" class="form-control" value="<?= htmlspecialchars($event['event_time'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?= htmlspecialchars($event['end_date'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control" value="<?= htmlspecialchars($event['end_time'] ?? '') ?>">
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($event['location'] ?? '') ?>">
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($event['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="upcoming" <?= $event['status'] == 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
                        <option value="ongoing" <?= $event['status'] == 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                        <option value="completed" <?= $event['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="cancelled" <?= $event['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="<?= (int)$event['display_order'] ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input type="checkbox" name="is_featured" value="1" <?= $event['is_featured'] ? 'checked' : '' ?> style="width:20px; height:20px;">
                        Featured Event (Shows first on homepage)
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label" style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input type="checkbox" name="is_published" value="1" <?= $event['is_published'] ? 'checked' : '' ?> style="width:20px; height:20px;">
                        Published (Visible to public)
                    </label>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Update Event</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
