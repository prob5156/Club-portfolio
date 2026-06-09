<?php
$pageTitle = "Media Center - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Dive into our collection of performances, rehearsals, memories and videos.";
$pageStylesheets = ['/Dhrupodi/css/pages/gallery.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';

$images = [
    '/Dhrupodi/images/Event 1.jpg',
    '/Dhrupodi/images/Event 2.jpg',
    '/Dhrupodi/images/Event 3.jpg',
    '/Dhrupodi/images/dhrupodi-screenshot.png',
    '/Dhrupodi/images/Event 1.jpg'
];
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

    <!-- Top Categories Grid -->
    <div class="top-categories">
        <!-- Events -->
        <div class="cat-card">
            <div class="cat-img-wrapper"><img src="/Dhrupodi/images/Event 1.jpg" alt="Events"></div>
            <div class="cat-content">
                <h3 class="cat-title">
                    <span class="cat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                    Events
                </h3>
                <p class="cat-desc">College events, cultural programs and special occasions.</p>
                <a href="gallery-events.php" class="cat-btn">View Gallery &rarr;</a>
            </div>
        </div>
        <!-- Stage Performances -->
        <div class="cat-card">
            <div class="cat-img-wrapper"><img src="/Dhrupodi/images/Event 2.jpg" alt="Stage"></div>
            <div class="cat-content">
                <h3 class="cat-title">
                    <span class="cat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/><path d="M12 6v6l4 2"/></svg></span>
                    Stage Performances
                </h3>
                <p class="cat-desc">Highlights from our stage performances and competitions.</p>
                <a href="gallery-stage.php" class="cat-btn">View Gallery &rarr;</a>
            </div>
        </div>
        <!-- Practice & Rehearsals -->
        <div class="cat-card">
            <div class="cat-img-wrapper"><img src="/Dhrupodi/images/Event 3.jpg" alt="Practice"></div>
            <div class="cat-content">
                <h3 class="cat-title">
                    <span class="cat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/><line x1="16" y1="8" x2="2" y2="22"/><line x1="17.5" y1="15" x2="9" y2="6.5"/></svg></span>
                    Practice & Rehearsals
                </h3>
                <p class="cat-desc">Behind the scenes moments from our practice sessions and rehearsals.</p>
                <a href="gallery-practice.php" class="cat-btn">View Gallery &rarr;</a>
            </div>
        </div>
        <!-- Random Memories -->
        <div class="cat-card">
            <div class="cat-img-wrapper"><img src="/Dhrupodi/images/Event 1.jpg" alt="Memories"></div>
            <div class="cat-content">
                <h3 class="cat-title">
                    <span class="cat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></span>
                    Random Memories
                </h3>
                <p class="cat-desc">Candid moments, fun times and unforgettable memories.</p>
                <a href="gallery-random.php" class="cat-btn">View Gallery &rarr;</a>
            </div>
        </div>
        <!-- Videos -->
        <div class="cat-card">
            <div class="cat-img-wrapper"><img src="/Dhrupodi/images/Event 2.jpg" alt="Videos"></div>
            <div class="cat-content">
                <h3 class="cat-title">
                    <span class="cat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/><line x1="7" y1="2" x2="7" y2="22"/><line x1="17" y1="2" x2="17" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><line x1="2" y1="7" x2="7" y2="7"/><line x1="2" y1="17" x2="7" y2="17"/><line x1="17" y1="17" x2="22" y2="17"/><line x1="17" y1="7" x2="22" y2="7"/></svg></span>
                    Videos
                </h3>
                <p class="cat-desc">Watch our performances, highlights and dance videos.</p>
                <a href="gallery-videos.php" class="cat-btn">View Gallery &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Section: Events -->
    <div class="media-container">
        <div class="media-container-header">
            <div class="mc-title-area">
                <div class="mc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                <div>
                    <h2>Events</h2>
                    <p>Memorable moments from our events and cultural programs.</p>
                </div>
            </div>
            <a href="#" class="mc-see-all">See All &rarr;</a>
        </div>
        <div class="media-grid">
            <?php foreach($images as $img): ?>
                <div class="media-item lightbox-trigger">
                    <img src="<?php echo $img; ?>" alt="Event">
                </div>
            <?php endforeach; ?>
            <div class="media-more-card">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span>+56<br>More</span>
            </div>
        </div>
    </div>

    <!-- Section: Stage Performances -->
    <div class="media-container">
        <div class="media-container-header">
            <div class="mc-title-area">
                <div class="mc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/><path d="M12 6v6l4 2"/></svg></div>
                <div>
                    <h2>Stage Performances</h2>
                    <p>Our stage shows, competitions and special performances.</p>
                </div>
            </div>
            <a href="#" class="mc-see-all">See All &rarr;</a>
        </div>
        <div class="media-grid">
            <?php foreach($images as $img): ?>
                <div class="media-item lightbox-trigger">
                    <img src="<?php echo $img; ?>" alt="Stage">
                </div>
            <?php endforeach; ?>
            <div class="media-more-card">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span>+42<br>More</span>
            </div>
        </div>
    </div>

    <!-- Section: Practice & Rehearsals -->
    <div class="media-container">
        <div class="media-container-header">
            <div class="mc-title-area">
                <div class="mc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/><line x1="16" y1="8" x2="2" y2="22"/><line x1="17.5" y1="15" x2="9" y2="6.5"/></svg></div>
                <div>
                    <h2>Practice & Rehearsals</h2>
                    <p>Glimpses of our hard work and dedication.</p>
                </div>
            </div>
            <a href="#" class="mc-see-all">See All &rarr;</a>
        </div>
        <div class="media-grid">
            <?php foreach($images as $img): ?>
                <div class="media-item lightbox-trigger">
                    <img src="<?php echo $img; ?>" alt="Practice">
                </div>
            <?php endforeach; ?>
            <div class="media-more-card">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span>+18<br>More</span>
            </div>
        </div>
    </div>

</div>

<!-- Lightbox Modal -->
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