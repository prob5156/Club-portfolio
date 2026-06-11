<?php
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->prepare("SELECT m.*, u.email FROM members m JOIN users u ON m.user_id = u.id WHERE m.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$member = $stmt->fetch();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '') ?: null;
    $bio = trim($_POST['bio'] ?? '') ?: null;
    $facebook = trim($_POST['facebook_url'] ?? '') ?: null;
    $instagram = trim($_POST['instagram_url'] ?? '') ?: null;
    $linkedin = trim($_POST['linkedin_url'] ?? '') ?: null;

    if (!$email) {
        $error = "Email is required.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $_SESSION['user_id']]);
        if ($stmt->fetch()) {
            $error = "Email already in use.";
        } else {
            $image_path = $member['image_path'];
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
                        $uploadDir = __DIR__ . '/../uploads/members/';
                        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                        
                        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
                        if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                            if ($image_path && file_exists(__DIR__ . '/../' . $image_path)) {
                                unlink(__DIR__ . '/../' . $image_path);
                            }
                            $image_path = 'uploads/members/' . $filename;
                        } else {
                            $error = "Failed to upload image.";
                        }
                    }
                }
            }

            if (!$error) {
                try {
                    $pdo->beginTransaction();

                    $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
                    $stmt->execute([$email, $_SESSION['user_id']]);

                    $stmt = $pdo->prepare("
                        UPDATE members SET 
                        phone = ?, bio = ?, image_path = ?, facebook_url = ?, instagram_url = ?, linkedin_url = ?
                        WHERE user_id = ?
                    ");
                    $stmt->execute([$phone, $bio, $image_path, $facebook, $instagram, $linkedin, $_SESSION['user_id']]);

                    $pdo->commit();
                    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Profile updated successfully!'];
                    header("Location: index.php");
                    exit();
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = "Failed to update profile.";
                }
            }
        }
    }
}
?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <h2>Edit Profile</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 40px; max-width: 800px; margin: 0 auto;">
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
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($member['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($member['phone'] ?? '') ?>">
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="5"><?= htmlspecialchars($member['bio'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Facebook URL</label>
                    <input type="url" name="facebook_url" class="form-control" value="<?= htmlspecialchars($member['facebook_url'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Instagram URL</label>
                    <input type="url" name="instagram_url" class="form-control" value="<?= htmlspecialchars($member['instagram_url'] ?? '') ?>">
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-control" value="<?= htmlspecialchars($member['linkedin_url'] ?? '') ?>">
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
