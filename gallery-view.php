<?php
$categoryId = isset($_GET['category']) ? $_GET['category'] : 'events';

$categories = [
    'events' => ['title' => 'Events', 'desc' => 'Highlights from our workshops, cultural nights, and special occasions.'],
    'stage' => ['title' => 'Stage Performances', 'desc' => 'Breathtaking moments from our live stage shows and recitals.'],
    'practice' => ['title' => 'Practice & Rehearsals', 'desc' => 'Behind the scenes looks at our dedication and hard work.'],
    'memories' => ['title' => 'Random Memories', 'desc' => 'Candid shots, fun times, and the bond we share as a team.'],
    'videos' => ['title' => 'Videos', 'desc' => 'Watch our full performances, trailers, and choreography videos.']
];

$currentCat = isset($categories[$categoryId]) ? $categories[$categoryId] : $categories['events'];

$pageTitle = $currentCat['title'] . " - Dhrupodi Dancers' Association - KUET";
$pageDescription = $currentCat['desc'];
$pageStylesheets = ['/Dhrupodi/css/pages/gallery.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	<section class="content gallery-view-page">
		<div class="gallery-header">
			<a href="/Dhrupodi/gallery.php" class="back-link">&larr; Back to Media Center</a>
			<h1 class="page-title"><?php echo htmlspecialchars($currentCat['title']); ?></h1>
			<p class="page-intro"><?php echo htmlspecialchars($currentCat['desc']); ?></p>
		</div>

        
        <div class="media-section videos-section">
            <h2 class="section-heading">Videos</h2>
            <div class="videos-grid">
                
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="/Dhrupodi/uploads/gallery/dhrupodi-screenshot.png" alt="Video Thumbnail">
                        <div class="play-btn">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3>Annual Classical Dance Night</h3>
                        <span class="video-date">Oct 12, 2025</span>
                    </div>
                </div>
                
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="/Dhrupodi/uploads/gallery/dhrupodi-screenshot.png" alt="Video Thumbnail">
                        <div class="play-btn">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3>Freshers' Reception Performance</h3>
                        <span class="video-date">Sep 05, 2025</span>
                    </div>
                </div>
                <?php if($categoryId === 'videos'): ?>
                
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="/Dhrupodi/uploads/gallery/dhrupodi-screenshot.png" alt="Video Thumbnail">
                        <div class="play-btn">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3>Inter-University Dance Fest</h3>
                        <span class="video-date">Aug 20, 2025</span>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="/Dhrupodi/uploads/gallery/dhrupodi-screenshot.png" alt="Video Thumbnail">
                        <div class="play-btn">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3>Kathak Workshop Highlights</h3>
                        <span class="video-date">Jul 15, 2025</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($categoryId !== 'videos'): ?>
        
        <div class="media-section images-section">
            <h2 class="section-heading">Images</h2>
            <div class="masonry-gallery">
                
                <?php for($i = 1; $i <= 12; $i++): 
                    
                    $hClass = ($i % 3 == 0) ? 'tall' : (($i % 4 == 0) ? 'short' : 'medium');
                ?>
                <div class="masonry-item <?php echo $hClass; ?>">
                    <img src="/Dhrupodi/uploads/gallery/dhrupodi-screenshot.png" alt="Gallery Image <?php echo $i; ?>" class="lightbox-trigger">
                    <div class="image-overlay">
                        <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>
	</section>

    
    <div class="lightbox" id="lightbox">
        <button class="lightbox-close" id="lightboxClose">&times;</button>
        <button class="lightbox-nav prev" id="lightboxPrev">&larr;</button>
        <button class="lightbox-nav next" id="lightboxNext">&rarr;</button>
        <div class="lightbox-content">
            <img id="lightboxImage" src="" alt="Expanded Image">
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const triggers = document.querySelectorAll('.lightbox-trigger');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightboxImage');
        const closeBtn = document.getElementById('lightboxClose');
        const prevBtn = document.getElementById('lightboxPrev');
        const nextBtn = document.getElementById('lightboxNext');
        
        let currentIndex = 0;
        const images = Array.from(triggers).map(img => img.src);

        if(triggers.length > 0) {
            triggers.forEach((trigger, index) => {
                trigger.addEventListener('click', () => {
                    currentIndex = index;
                    showLightbox();
                });
            });

            closeBtn.addEventListener('click', hideLightbox);
            
            lightbox.addEventListener('click', (e) => {
                if(e.target === lightbox || e.target.classList.contains('lightbox-content')) {
                    hideLightbox();
                }
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
