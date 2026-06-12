<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    /* Go back */
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT m.*, u.email FROM members m JOIN users u ON m.user_id = u.id WHERE m.id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();

if (!$member) {
    // Redirect after success
    header("Location: index.php");
    exit();
}

$error = '';
// Check post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    // Optional fields default to NULL if empty string
    $role_title = trim($_POST['role_title'] ?? '') ?: null;
    $department = trim($_POST['department'] ?? '') ?: null;
    $batch = trim($_POST['batch'] ?? '') ?: null;
    $bio = trim($_POST['bio'] ?? '') ?: null;
    $phone = trim($_POST['phone'] ?? '') ?: null;
    $facebook = trim($_POST['facebook_url'] ?? '') ?: null;
    $instagram = trim($_POST['instagram_url'] ?? '') ?: null;
    $linkedin = trim($_POST['linkedin_url'] ?? '') ?: null;
    $display_order = (int)($_POST['display_order'] ?? 0);
    $status = $_POST['status'] ?? 'active';

    if (!$name || !$email) {
        $error = "Name and Email are required.";
    } else {
        // Check email uniqueness across other users
        /* Connect database */
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $member['user_id']]);
        if ($stmt->fetch()) {
            $error = "Email already in use by another user.";
        } else {
            // Handle image upload with validation
            $image_path = $member['image_path'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['image']['tmp_name'];
                $fileSize = $_FILES['image']['size'];
                
                // 1. Max size: 5MB
                if ($fileSize > 5 * 1024 * 1024) {
                    $error = "Image size must be less than 5 MB.";
                } else {
                    // 2. Validate MIME type server-side
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_file($finfo, $fileTmp);
                    finfo_close($finfo);
                    
                    $allowedMimes = [
                        'image/jpeg' => 'jpg',
                        'image/png' => 'png',
                        'image/webp' => 'webp'
                    ];
                    
                    if (!array_key_exists($mimeType, $allowedMimes)) {
                        $error = "Only JPG, PNG, and WEBP images are allowed.";
                    } else {
                        $extension = $allowedMimes[$mimeType];
                        $uploadDir = __DIR__ . '/../../uploads/members/';
                        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                        
                        // 3. Cryptographically unique filename
                        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
                        if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                            // Delete old image safely
                            if ($image_path && file_exists(__DIR__ . '/../../' . $image_path)) {
                                unlink(__DIR__ . '/../../' . $image_path);
                            }
                            $image_path = 'uploads/members/' . $filename;
                        } else {
                            $error = "Failed to save the uploaded image.";
                        }
                    }
                }
            }

            // Proceed if no errors during image upload
            if (!$error) {
                try {
                    $pdo->beginTransaction();

                    // 1. Update User Email
                    // db call
                    $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
                    $stmt->execute([$email, $member['user_id']]);

                    // 2. Update Member Details
                    $stmt = $pdo->prepare("
                        UPDATE members SET 
                        name = ?, role_title = ?, department = ?, batch = ?, bio = ?, 
                        image_path = ?, display_order = ?, facebook_url = ?, instagram_url = ?, 
                        linkedin_url = ?, phone = ?, status = ?
                        WHERE id = ?
                    ");
                    $stmt->execute([
                        $name, $role_title, $department, $batch, $bio, 
                        $image_path, $display_order, $facebook, $instagram, 
                        $linkedin, $phone, $status, $id
                    ]);

                    $pdo->commit();
                    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Member updated successfully!'];
                    /* Go back */
                    header("Location: index.php");
                    exit();
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = "Failed to update member: " . $e->getMessage();
                }
            }
        }
    }
}
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <a href="index.php" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to Members</a>
        <h2>Edit Member: <?= htmlspecialchars($member['name']) ?></h2>
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
                    <?php if($member['image_path']): ?>
                        <img src="/Dhrupodi/<?= htmlspecialchars($member['image_path']) ?>" alt="" style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px; border: 2px solid var(--glass-border);">
                    <?php else: ?>
                        <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);">No Image</div>
                    <?php endif; ?>
                    <div>
                        <label class="form-label">Update Profile Image (Max 5MB)</label>
                        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($member['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($member['email']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Designation</label>
                    <input type="text" name="role_title" class="form-control" value="<?= htmlspecialchars($member['role_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($member['department'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Batch</label>
                    <input type="text" name="batch" class="form-control" value="<?= htmlspecialchars($member['batch'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($member['phone'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= $member['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="alumni" <?= $member['status'] == 'alumni' ? 'selected' : '' ?>>Alumni</option>
                        <option value="hidden" <?= $member['status'] == 'hidden' ? 'selected' : '' ?>>Hidden</option>
                    </select>
                </div>
                
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4"><?= htmlspecialchars($member['bio'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Facebook URL</label>
                    <input type="url" name="facebook_url" class="form-control" value="<?= htmlspecialchars($member['facebook_url'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Instagram URL</label>
                    <input type="url" name="instagram_url" class="form-control" value="<?= htmlspecialchars($member['instagram_url'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-control" value="<?= htmlspecialchars($member['linkedin_url'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="<?= (int)$member['display_order'] ?>">
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Update Member</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
