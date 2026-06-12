<?php
require_once __DIR__ . '/includes/header.php';

// get member count
$stmt = $pdo->query("SELECT COUNT(*) FROM members WHERE status = 'active'");
$totalMembers = $stmt->fetchColumn() ?: 0;

$stmt = $pdo->query("SELECT COUNT(*) FROM events WHERE status != 'cancelled'");
$totalEvents = $stmt->fetchColumn() ?: 0;

/* notices count */
$stmt = $pdo->query("SELECT COUNT(*) FROM notices");
$totalNotices = $stmt->fetchColumn() ?: 0;

// execute query
$stmt = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'unread'");
$unreadMessages = $stmt->fetchColumn() ?: 0;

$stmt = $pdo->query("SELECT COUNT(*) FROM gallery_images");
$totalImages = $stmt->fetchColumn() ?: 0;
?>

<div class="dashboard-content">
    <h3 style="font-size: 2rem; margin-bottom: 5px;">Dashboard Overview</h3>
    <p style="color: var(--color-text-muted); margin-bottom: 30px; font-size: 1.1rem;">Welcome to the Dhrupodi Admin Panel. Manage your association seamlessly.</p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px;">
        
        <div class="dashboard-card">
            <div class="card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="card-content">
                <h4>Total Active Members</h4>
                <h2><?= $totalMembers ?></h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
            <div class="card-content">
                <h4>Total Events</h4>
                <h2><?= $totalEvents ?></h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </div>
            <div class="card-content">
                <h4>Notices</h4>
                <h2><?= $totalNotices ?></h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            </div>
            <div class="card-content">
                <h4>Gallery Images</h4>
                <h2><?= $totalImages ?></h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </div>
            <div class="card-content">
                <h4>Unread Messages</h4>
                <h2 style="<?= $unreadMessages > 0 ? 'color: #ef4444;' : '' ?>"><?= $unreadMessages ?></h2>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/includes/footer.php';
?>
