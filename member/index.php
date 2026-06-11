<?php
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->prepare("SELECT m.*, u.email FROM members m JOIN users u ON m.user_id = u.id WHERE m.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$member = $stmt->fetch();

if (!$member) {
    echo "<div class='content-area'><h2>Profile not found.</h2></div>";
    require_once __DIR__ . '/includes/footer.php';
    exit;
}
?>
<div class="content-area">
    <div style="margin-bottom: 30px;">
        <h2>My Profile</h2>
    </div>

    <div class="dashboard-card" style="flex-direction: column; align-items: stretch; padding: 40px; max-width: 800px; margin: 0 auto;">
        <div style="display: flex; align-items: center; gap: 30px; margin-bottom: 40px; border-bottom: 1px solid var(--glass-border); padding-bottom: 30px;">
            <?php if($member['image_path']): ?>
                <img src="/Dhrupodi/<?= htmlspecialchars($member['image_path']) ?>" alt="Profile" style="width: 150px; height: 150px; object-fit: cover; border-radius: 20px; border: 3px solid var(--glass-border);">
            <?php else: ?>
                <div style="width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted); font-size: 1.2rem;">No Image</div>
            <?php endif; ?>
            
            <div>
                <h1 style="font-size: 2.5rem; margin-bottom: 5px;"><?= htmlspecialchars($member['name']) ?></h1>
                <p style="color: var(--color-accent); font-weight: 600; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;"><?= htmlspecialchars($member['role_title'] ?? 'Member') ?></p>
                <p style="color: var(--color-text-muted); margin-top: 5px;"><?= htmlspecialchars($member['email']) ?></p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div>
                <h3 style="color: var(--color-text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Department</h3>
                <p style="font-size: 1.1rem; font-weight: 500;"><?= htmlspecialchars($member['department'] ?? 'Not Specified') ?></p>
            </div>
            <div>
                <h3 style="color: var(--color-text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Batch</h3>
                <p style="font-size: 1.1rem; font-weight: 500;"><?= htmlspecialchars($member['batch'] ?? 'Not Specified') ?></p>
            </div>
            <div>
                <h3 style="color: var(--color-text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Phone</h3>
                <p style="font-size: 1.1rem; font-weight: 500;"><?= htmlspecialchars($member['phone'] ?? 'Not Specified') ?></p>
            </div>
            <div style="grid-column: 1 / -1;">
                <h3 style="color: var(--color-text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Bio</h3>
                <p style="font-size: 1.05rem; line-height: 1.6;"><?= nl2br(htmlspecialchars($member['bio'] ?? 'No bio provided.')) ?></p>
            </div>
            
            <div style="grid-column: 1 / -1; margin-top: 10px;">
                <h3 style="color: var(--color-text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">Social Links</h3>
                <div style="display: flex; gap: 15px;">
                    <?php if($member['facebook_url']): ?><a href="<?= htmlspecialchars($member['facebook_url']) ?>" target="_blank" class="btn btn-secondary">Facebook</a><?php endif; ?>
                    <?php if($member['instagram_url']): ?><a href="<?= htmlspecialchars($member['instagram_url']) ?>" target="_blank" class="btn btn-secondary">Instagram</a><?php endif; ?>
                    <?php if($member['linkedin_url']): ?><a href="<?= htmlspecialchars($member['linkedin_url']) ?>" target="_blank" class="btn btn-secondary">LinkedIn</a><?php endif; ?>
                    <?php if(!$member['facebook_url'] && !$member['instagram_url'] && !$member['linkedin_url']): ?>
                        <p style="color: var(--color-text-muted);">No social links added.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 40px; text-align: center;">
            <a href="edit_profile.php" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">Edit Profile</a>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
