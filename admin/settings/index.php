<?php
require_once __DIR__ . '/../../config/auth.php';
requireAdmin();

$expected_settings = [
    'site_title' => 'Dhrupodi Dancers\' Association',
    'contact_email' => 'dhrupodi@kuet.ac.bd',
    'contact_phone' => '+880 1234-567890',
    'contact_address' => 'KUET Campus, Khulna, Bangladesh',
    'about_footer' => 'A classical dance association dedicated to promoting and preserving traditional dance forms among KUET students.',
    'facebook_url' => '#',
    'instagram_url' => '#',
    'linkedin_url' => '#',
    'youtube_url' => '#'
];

// Pre-fill DB if missing
foreach ($expected_settings as $key => $default_val) {
    // execute query
    $stmt = $pdo->prepare("SELECT setting_value FROM website_settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    if (!$stmt->fetch()) {
        $ins = $pdo->prepare("INSERT INTO website_settings (setting_key, setting_value) VALUES (?, ?)");
        $ins->execute([$key, $default_val]);
    }
}

// Form validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings = $_POST['settings'] ?? [];
    // show list
    foreach ($settings as $key => $value) {
        $stmt = $pdo->prepare("UPDATE website_settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->execute([$value, $key]);
    }
    $_SESSION['toast'] = ['type' => 'success', 'message' => 'Settings updated successfully!'];
    header("Location: index.php");
    exit();
}

$stmt = $pdo->query("SELECT setting_key, setting_value FROM website_settings");
$current_settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

require_once __DIR__ . '/../includes/header.php';
?>

<div class="content-area">
    <div style="margin-bottom: 30px;">
        <h2>Website Settings</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 30px;">
        <form method="POST" action="">
            
            <h3 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.1);">General Information</h3>
            <div style="display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 40px;">
                <div class="form-group">
                    <label class="form-label">Site Title</label>
                    <input type="text" name="settings[site_title]" class="form-control" value="<?= htmlspecialchars($current_settings['site_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Footer About Text</label>
                    <textarea name="settings[about_footer]" class="form-control" rows="3"><?= htmlspecialchars($current_settings['about_footer'] ?? '') ?></textarea>
                </div>
            </div>

            <h3 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.1);">Contact Details</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                <div class="form-group">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="settings[contact_email]" class="form-control" value="<?= htmlspecialchars($current_settings['contact_email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" name="settings[contact_phone]" class="form-control" value="<?= htmlspecialchars($current_settings['contact_phone'] ?? '') ?>">
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label class="form-label">Address</label>
                    <input type="text" name="settings[contact_address]" class="form-control" value="<?= htmlspecialchars($current_settings['contact_address'] ?? '') ?>">
                </div>
            </div>

            <h3 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.1);">Social Links</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                <div class="form-group">
                    <label class="form-label">Facebook URL</label>
                    <input type="url" name="settings[facebook_url]" class="form-control" value="<?= htmlspecialchars($current_settings['facebook_url'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Instagram URL</label>
                    <input type="url" name="settings[instagram_url]" class="form-control" value="<?= htmlspecialchars($current_settings['instagram_url'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="url" name="settings[linkedin_url]" class="form-control" value="<?= htmlspecialchars($current_settings['linkedin_url'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">YouTube URL</label>
                    <input type="url" name="settings[youtube_url]" class="form-control" value="<?= htmlspecialchars($current_settings['youtube_url'] ?? '') ?>">
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Save Settings</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
