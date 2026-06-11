<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

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
        // Image validation
        $image_path = null;
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
                        $image_path = 'uploads/events/' . $filename;
                    } else {
                        $error = "Failed to save the uploaded image.";
                    }
                }
            }
        }

        if (!$error) {
            try {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-')) . '-' . time();
                
                $stmt = $pdo->prepare("
                    INSERT INTO events (title, slug, event_date, event_time, end_date, end_time, location, description, image_path, is_featured, is_published, status, display_order)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $title, $slug, $event_date, $event_time, $end_date, $end_time, $location, $description, $image_path, $is_featured, $is_published, $status, $display_order
                ]);

                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Event added successfully!'];
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $error = "Failed to add event: " . $e->getMessage();
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Events</a>
        <h2>Add New Event</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 30px;">
        <?php if($error): ?>
            <div style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Event Title *</label>
                    <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Start Date *</label>
                    <input type="date" name="event_date" class="form-control" required value="<?= htmlspecialchars($_POST['event_date'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="event_time" class="form-control" value="<?= htmlspecialchars($_POST['event_time'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?= htmlspecialchars($_POST['end_date'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control" value="<?= htmlspecialchars($_POST['end_time'] ?? '') ?>">
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>">
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Cover Image (Max 5MB)</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="upcoming">Upcoming</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input type="checkbox" name="is_featured" value="1" style="width:20px; height:20px;">
                        Featured Event (Shows first on homepage)
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label" style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <input type="checkbox" name="is_published" value="1" checked style="width:20px; height:20px;">
                        Published (Visible to public)
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="0">
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Save Event</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
