<?php
require_once __DIR__ . '/config/database.php';

$stmt = $pdo->prepare("SELECT * FROM events WHERE is_published = 1 AND status != 'cancelled' ORDER BY is_featured DESC, event_date ASC");
$stmt->execute();
$allEvents = $stmt->fetchAll();

$pageTitle = "Events - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Upcoming events and performances by Dhrupodi Dancers' Association of KUET - workshops, recitals, and cultural programs.";
$pageStylesheets = ['/Dhrupodi/css/pages/events.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

<div class="events-hero">
    <h1 class="hero-title">OUR EVENTS</h1>
    <div class="hero-divider">
        <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
    </div>
    <div class="hero-subtitle">CELEBRATING DANCE, CULTURE & COMMUNITY</div>
</div>

<section class="events-body">
    <div class="section-heading-wrapper">
        <h2 class="section-heading">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            UPCOMING EVENTS
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </h2>
    </div>

    <div class="e-cards-grid">
        <?php foreach ($allEvents as $event): ?>
        <div class="e-card">
            <div class="e-card-img-box">
                <?php if($event['image_path']): ?>
                    <img src="/Dhrupodi/<?= htmlspecialchars($event['image_path']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" onerror="this.src='/Dhrupodi/images/Homepage/home%20face.png'">
                <?php else: ?>
                    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="Event">
                <?php endif; ?>
                <div class="e-date-badge">
                    <span class="month"><?= date('M', strtotime($event['event_date'])) ?></span>
                    <span class="day"><?= date('d', strtotime($event['event_date'])) ?></span>
                </div>
            </div>
            <div class="e-card-content">
                <h3 class="e-card-title"><?= htmlspecialchars($event['title']) ?></h3>
                <div class="e-meta">
                    <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <?= htmlspecialchars($event['location'] ?? 'Venue TBA') ?>
                </div>
                <div class="e-meta">
                    <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    <?= htmlspecialchars($event['event_time'] ?? 'Time TBA') ?>
                </div>
                <p class="e-desc"><?= htmlspecialchars(mb_substr($event['description'] ?? '', 0, 150)) . (mb_strlen($event['description'] ?? '') > 150 ? '...' : '') ?></p>
                <a href="#" class="e-btn">
                    View Details
                    <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if(empty($allEvents)): ?>
            <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">More exciting events coming soon!</div>
        <?php endif; ?>
    </div>

    <div class="e-footer">
        <div class="e-footer-line"></div>
        <div class="e-footer-content">
            <svg viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5z"/></svg>
            More events coming soon. Stay tuned!
        </div>
    </div>
</section>

<?php require_once 'php/footer.php'; ?>