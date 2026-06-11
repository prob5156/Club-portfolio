<?php
require_once __DIR__ . '/config/database.php';

$stmt = $pdo->prepare("SELECT * FROM gallery_categories WHERE is_active = 1 ORDER BY display_order ASC");
$stmt->execute();
$dbCategories = $stmt->fetchAll();

$stmt = $pdo->prepare("
    SELECT gi.*, gc.name as category_name, gc.slug as category_slug 
    FROM gallery_images gi 
    LEFT JOIN gallery_categories gc ON gi.category_id = gc.id 
    WHERE gi.is_published = 1 
    ORDER BY gi.display_order ASC
");
$stmt->execute();
$dbImages = $stmt->fetchAll();

$categories = $dbCategories;
$imagesByCategory = [];
foreach ($dbImages as $img) {
    $imagesByCategory[$img['category_id']][] = $img;
}

$pageTitle = "Media Center - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Dive into our collection of performances, rehearsals, memories and videos.";
$pageStylesheets = ['/Dhrupodi/css/pages/gallery.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

<style>
body {
    background: url('/Dhrupodi/images/bg gallery.png') no-repeat top center fixed !important;
    background-size: cover !important;
}
</style>

<div class="gallery-page">
    <div class="gallery-header">
        <div class="section-kicker">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            MEDIA CENTER
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        </div>
        <h1 class="page-title">Explore Our Media</h1>
        <p class="page-intro">Dive into our collection of performances, rehearsals, memories and videos.</p>
        <div class="header-divider"></div>
    </div>

    
    <div class="top-categories">
        <?php foreach ($categories as $cat): ?>
        <div class="cat-card">
            <div class="cat-img-wrapper">
                <?php 
                $firstImg = !empty($imagesByCategory[$cat['id']]) ? $imagesByCategory[$cat['id']][0]['image_path'] : 'images/Homepage/home%20face.png';
                ?>
                <img src="/Dhrupodi/<?= htmlspecialchars(ltrim($firstImg, '/')) ?>" alt="<?= htmlspecialchars($cat['name']) ?>">
            </div>
            <div class="cat-content">
                <h3 class="cat-title">
                    <span class="cat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?= $cat['icon_svg'] ?? '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>' ?></svg></span>
                    <?= htmlspecialchars($cat['name']) ?>
                </h3>
                <p class="cat-desc"><?= htmlspecialchars($cat['description'] ?? '') ?></p>
                <a href="gallery-view.php?category=<?= htmlspecialchars($cat['slug']) ?>" class="cat-btn">View Gallery &rarr;</a>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if(empty($categories)): ?>
            <div style="grid-column: 1/-1; padding: 60px 20px; text-align: center; color: var(--color-text-muted); font-size: 1.2rem;">
                Gallery collections will be updated soon.
            </div>
        <?php endif; ?>
    </div>

    
    <?php foreach ($categories as $cat): ?>
    <div class="media-container">
        <div class="media-container-header">
            <div class="mc-title-area">
                <div class="mc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?= $cat['icon_svg'] ?? '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>' ?></svg></div>
                <div>
                    <h2><?= htmlspecialchars($cat['name']) ?></h2>
                    <p><?= htmlspecialchars($cat['description'] ?? '') ?></p>
                </div>
            </div>
            <a href="gallery-view.php?category=<?= htmlspecialchars($cat['slug']) ?>" class="mc-see-all">See All &rarr;</a>
        </div>
        <div class="media-grid">
            <?php 
            $catImages = $imagesByCategory[$cat['id']] ?? [];
            foreach(array_slice($catImages, 0, 8) as $img): ?>
                <div class="media-item lightbox-trigger">
                    <img src="/Dhrupodi/<?= htmlspecialchars(ltrim($img['image_path'], '/')) ?>" alt="<?= htmlspecialchars($cat['name']) ?>">
                </div>
            <?php endforeach; ?>
            <?php if(count($catImages) > 8): ?>
            <div class="media-more-card" onclick="window.location.href='gallery-view.php?category=<?= htmlspecialchars($cat['slug']) ?>'" style="cursor:pointer;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span>+<?= count($catImages) - 8 ?><br>More</span>
            </div>
            <?php endif; ?>
            <?php if(empty($catImages)): ?>
                <div style="grid-column: 1/-1; padding: 20px; color: var(--color-text-muted);">No images yet.</div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>

</div>


<div class="lightbox" id="lightbox">
    <button class="lightbox-btn lightbox-close" id="lightboxClose">&times;</button>
    <button class="lightbox-btn lightbox-prev" id="lightboxPrev">&larr;</button>
    <button class="lightbox-btn lightbox-next" id="lightboxNext">&rarr;</button>
    <img id="lightboxImage" src="" alt="Expanded Image">
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const triggers = document.querySelectorAll('.lightbox-trigger img');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImage');
    const closeBtn = document.getElementById('lightboxClose');
    const prevBtn = document.getElementById('lightboxPrev');
    const nextBtn = document.getElementById('lightboxNext');
    
    let currentIndex = 0;
    const images = Array.from(triggers).map(img => img.src);

    if(triggers.length > 0) {
        triggers.forEach((trigger, index) => {
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                currentIndex = index;
                showLightbox();
            });
        });

        closeBtn.addEventListener('click', hideLightbox);
        
        lightbox.addEventListener('click', (e) => {
            if(e.target === lightbox) hideLightbox();
        });

        prevBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
            updateImage();
        });

        nextBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
            updateImage();
        });

        document.addEventListener('keydown', (e) => {
            if(!lightbox.classList.contains('active')) return;
            if(e.key === 'Escape') hideLightbox();
            if(e.key === 'ArrowLeft') prevBtn.click();
            if(e.key === 'ArrowRight') nextBtn.click();
        });
    }

    function showLightbox() {
        updateImage();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function hideLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function updateImage() {
        lightboxImg.src = images[currentIndex];
    }
});
</script>

<?php require_once 'php/footer.php'; ?>