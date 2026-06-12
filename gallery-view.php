<?php
require_once __DIR__ . '/config/database.php';

$categorySlug = isset($_GET['category']) ? $_GET['category'] : '';

/* Connect database */
$stmt = $pdo->prepare("SELECT * FROM gallery_categories WHERE slug = ? AND is_active = 1");
$stmt->execute([$categorySlug]);
$currentCat = $stmt->fetch();

if (!$currentCat) {
    header("Location: gallery.php");
    exit();
}

// Get records from db
$stmt = $pdo->prepare("SELECT * FROM gallery_images WHERE category_id = ? AND is_published = 1 ORDER BY display_order ASC");
$stmt->execute([$currentCat['id']]);
$catImages = $stmt->fetchAll();


$pageTitle = $currentCat['title'] . " - Dhrupodi Dancers' Association - KUET";
$pageDescription = $currentCat['desc'];
$pageStylesheets = ['/Dhrupodi/css/pages/gallery.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	<section class="content gallery-view-page">
		<div class="gallery-header">
			<a href="/Dhrupodi/gallery.php" class="back-link">&larr; Back to Media Center</a>
			<h1 class="page-title"><?php echo htmlspecialchars($currentCat['name']); ?></h1>
			<p class="page-intro"><?php echo htmlspecialchars($currentCat['description'] ?? ''); ?></p>
		</div>

        <div class="media-section images-section">
            <h2 class="section-heading">Images</h2>
            <div class="masonry-gallery">
                <?php foreach($catImages as $index => $img): 
                    $hClass = ($index % 3 == 0) ? 'tall' : (($index % 4 == 0) ? 'short' : 'medium');
                ?>
                <div class="masonry-item <?php echo $hClass; ?>">
                    <img src="/Dhrupodi/<?= htmlspecialchars(ltrim($img['image_path'], '/')) ?>" alt="<?= htmlspecialchars($currentCat['name']) ?>" class="lightbox-trigger">
                    <div class="image-overlay">
                        <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php if(empty($catImages)): ?>
                    <div style="grid-column: 1/-1; padding: 60px 20px; text-align: center; color: var(--color-text-muted); font-size: 1.2rem;">
                        No images found in this gallery collection.
                    </div>
                <?php endif; ?>
            </div>
        </div>
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
