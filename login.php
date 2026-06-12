<?php
// login.php
require_once __DIR__ . '/config/auth.php';

/* If user is already logged in, redirect them */
if (isLoggedIn()) {
    if (getUserRole() === 'admin') header("Location: /Dhrupodi/admin/index.php");
    else header("Location: /Dhrupodi/member/index.php");
    exit();
}

$error = '';
/* Handle form submission */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get form data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Check password match
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $pdo->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?")->execute([$user['id']]);

            /* Handle Remember Me logic */
            if (isset($_POST['remember_me'])) {
                $selector = bin2hex(random_bytes(16));
                $validator = bin2hex(random_bytes(32));
                $validatorHash = hash('sha256', $validator);
                
                $expiresAt = new DateTime('+30 days');
                
                $stmt = $pdo->prepare("INSERT INTO user_tokens (user_id, selector, validator_hash, expires_at) VALUES (?, ?, ?, ?)");
                $stmt->execute([$user['id'], $selector, $validatorHash, $expiresAt->format('Y-m-d H:i:s')]);
                
                // set cookie
                $cookieValue = $selector . ':' . $validator;
                setcookie('remember_me', $cookieValue, [
                    'expires' => $expiresAt->getTimestamp(),
                    'path' => '/',
                    'secure' => isset($_SERVER['HTTPS']),
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]);
            }

            if ($user['role'] === 'admin') {
                // redirect user
                header("Location: /Dhrupodi/admin/index.php");
            } else {
                /* Page redirect */
                header("Location: /Dhrupodi/member/index.php");
            }
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dhrupodi</title>
    <link rel="stylesheet" href="/Dhrupodi/admin/assets/css/admin.css">
    <style>
        .auth-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
        }
        .auth-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }
        .auth-card h2 { margin-bottom: 30px; font-size: 2rem; }
        .form-group { text-align: left; }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <h2>Welcome Back</h2>
            <?php if($error): ?>
                <div style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 10px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                    <input type="checkbox" name="remember_me" id="remember_me" style="width: auto;">
                    <label for="remember_me" style="margin: 0; color: var(--color-text-muted); font-size: 0.95rem;">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px; padding: 12px; font-size: 1.1rem;">Login</button>
            </form>
            <p style="margin-top: 20px; color: var(--color-text-muted);">
                Don't have an account? <a href="signup.php" style="color: var(--color-accent); text-decoration: none;">Sign up here</a>
            </p>
        </div>
    </div>
</body>
</html>
