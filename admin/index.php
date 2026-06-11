<?php
require_once __DIR__ . '/includes/header.php';

$stmt = $pdo->query("SELECT COUNT(*) FROM members WHERE status = 'active'");
$totalMembers = $stmt->fetchColumn() ?: 0;

$stmt = $pdo->query("SELECT COUNT(*) FROM events WHERE status != 'cancelled'");
$totalEvents = $stmt->fetchColumn() ?: 0;
?>

<div class="dashboard-content">
    <h3 style="font-size: 2rem; margin-bottom: 5px;">Dashboard Overview</h3>
    <p style="color: var(--color-text-muted); margin-bottom: 30px; font-size: 1.1rem;">Welcome to the Dhrupodi Admin Panel. Manage your association seamlessly.</p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px;">
        
        <div class="dashboard-card">
            <div class="card-icon">
                <!-- SVG Icon for Members -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="card-content">
                <h4>Total Members</h4>
                <h2><?= $totalMembers ?></h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <!-- SVG Icon for Events -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
            <div class="card-content">
                <h4>Total Events</h4>
                <h2><?= $totalEvents ?></h2>
            </div>
        </div>

        <!-- Notices placeholder removed as per instructions to not create Notices module unless explicitly asked -->
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
