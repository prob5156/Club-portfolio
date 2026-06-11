<?php
// signup.php
require_once __DIR__ . '/config/auth.php';

if (isLoggedIn()) {
    if (getUserRole() === 'admin') header("Location: /Dhrupodi/admin/index.php");
    else header("Location: /Dhrupodi/member/index.php");
    exit();
}

$error = '';
$emailExistsError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $department = trim($_POST['department'] ?? '') ?: null;
    $batch = trim($_POST['batch'] ?? '') ?: null;
    $phone = trim($_POST['phone'] ?? '') ?: null;
    
    if (!$name || !$email || !$password || !$confirm_password) {
        $error = "Name, Email, and Password are required fields.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $emailExistsError = true;
        } else {
            // Handle Profile Picture
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
                        $uploadDir = __DIR__ . '/uploads/members/';
                        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                        
                        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
                        if (move_uploaded_file($fileTmp, $uploadDir . $filename)) {
                            $image_path = 'uploads/members/' . $filename;
                        } else {
                            $error = "Failed to upload image.";
                        }
                    }
                }
            }

            if (!$error && !$emailExistsError) {
                try {
                    $pdo->beginTransaction();

                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, 'member')");
                    $stmt->execute([$email, $hash]);
                    $userId = $pdo->lastInsertId();

                    $catStmt = $pdo->prepare("SELECT id FROM member_categories ORDER BY id ASC LIMIT 1");
                    $catStmt->execute();
                    $cat = $catStmt->fetch();
                    $categoryId = $cat ? $cat['id'] : null;

                    if (!$categoryId) {
                        $insCatStmt = $pdo->prepare("INSERT INTO member_categories (name, slug) VALUES (?, ?)");
                        $insCatStmt->execute(['General', 'general']);
                        $categoryId = $pdo->lastInsertId();
                    }

                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-')) . '-' . time();
                    $stmt = $pdo->prepare("
                        INSERT INTO members (user_id, category_id, name, slug, department, batch, phone, image_path, status)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active')
                    ");
                    $stmt->execute([$userId, $categoryId, $name, $slug, $department, $batch, $phone, $image_path]);

                    $pdo->commit();
                    
                    // Auto login
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['role'] = 'member';
                    header("Location: /Dhrupodi/member/index.php");
                    exit();
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = "An error occurred during registration. Please try again.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us - Dhrupodi</title>
    <link rel="stylesheet" href="/Dhrupodi/admin/assets/css/admin.css">
    <style>
        .auth-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            padding: 40px 20px;
        }
        .auth-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 600px;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }
        .auth-card h2 { margin-bottom: 30px; font-size: 2rem; }
        .form-group { text-align: left; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <h2>Join Dhrupodi</h2>
            
            <?php if($emailExistsError): ?>
                <div style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
                    This email is already registered.<br><br>
                    <a href="login.php" class="btn btn-primary" style="margin-top: 10px; display: inline-block;">Login Instead</a>
                </div>
            <?php elseif($error): ?>
                <div style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 10px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password *</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($_POST['department'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Batch</label>
                        <input type="text" name="batch" class="form-control" value="<?= htmlspecialchars($_POST['batch'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Profile Picture (Max 5MB)</label>
                        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px; padding: 12px; font-size: 1.1rem;">Register</button>
            </form>
            
            <p style="margin-top: 20px; color: var(--color-text-muted);">
                Already have an account? <a href="login.php" style="color: var(--color-accent); text-decoration: none;">Login here</a>
            </p>
        </div>
    </div>
</body>
</html>
