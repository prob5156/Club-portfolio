<?php
// index.php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/database.php';

/* check login status */
/* Verify user */
if (isLoggedIn()) {
    if (getUserRole() === 'admin') {
        header("Location: /Dhrupodi/admin/index.php");
    } else {
        header("Location: /Dhrupodi/member/index.php");
    }
    exit();
}

// Fetch latest events
$stmt = $pdo->prepare("SELECT * FROM events WHERE is_published = 1 AND status != 'cancelled' ORDER BY is_featured DESC, event_date ASC LIMIT 6");
$stmt->execute();
$homeEvents = $stmt->fetchAll();

/* Fetch data */
$stmt = $pdo->prepare("SELECT * FROM members WHERE status = 'active' ORDER BY display_order ASC LIMIT 11");
$stmt->execute();
$homeMembers = $stmt->fetchAll();

/* Get achievements */
// db call
$stmt = $pdo->prepare("SELECT * FROM achievements WHERE is_active = 1 ORDER BY display_order ASC LIMIT 4");
$stmt->execute();
$homeAchievements = $stmt->fetchAll();

// load gallery images for homepage
$stmt = $pdo->prepare("SELECT * FROM gallery_images WHERE is_published = 1 ORDER BY display_order ASC LIMIT 8");
$stmt->execute();
$homeGallery = $stmt->fetchAll();

/* Fetch slider data */
$stmt = $pdo->prepare("SELECT * FROM home_slider WHERE is_active = 1 ORDER BY display_order ASC LIMIT 5");
$stmt->execute();
$homeSlider = $stmt->fetchAll();

$pageTitle = "Dhrupodi Dancers' Association - KUET";
$pageDescription = "Welcome to Dhrupodi Dancers' Association of KUET - Celebrating the grace of tradition and the energy of movement.";
$pageStylesheets = ['/Dhrupodi/css/pages/home.css']; 
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

<script>
    document.body.classList.add('home-page');
</script>

<!-- Hero section with slider -->
<?php if (!empty($homeSlider)): ?>
    <div class="home-slider-container" style="position:relative; width:100%; height:100vh; overflow:hidden;">
        <?php foreach ($homeSlider as $index => $slide): ?>
            <section class="hero-pixel slide-item <?= $index === 0 ? 'active' : '' ?>" style="position:<?= $index === 0 ? 'relative' : 'absolute' ?>; top:0; left:0; width:100%; height:100%; opacity:<?= $index === 0 ? '1' : '0' ?>; transition: opacity 1s ease-in-out; <?= $slide['image_path'] ? 'background-image: url(/Dhrupodi/' . htmlspecialchars($slide['image_path']) . ');' : '' ?> background-size: cover; background-position: center; z-index: <?= $index === 0 ? '1' : '0' ?>;">
                <div class="hero-content" style="z-index:2; position:relative; background: rgba(0,0,0,0.4); padding: 40px; border-radius: 10px;">
                    <h1 class="hero-title"><?= $slide['title'] ?></h1>
                    <?php if ($slide['subtitle']): ?>
                        <p class="hero-subtitle"><?= $slide['subtitle'] ?></p>
                    <?php endif; ?>
                    <?php if ($slide['button_text']): ?>
                        <a href="<?= htmlspecialchars($slide['button_link'] ?: '#') ?>" class="btn-pill">
                            <?= htmlspecialchars($slide['button_text']) ?>
                            <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </section>
        <?php endforeach; ?>
        <?php if (count($homeSlider) > 1): ?>
            <script>
                // simple slider script
                document.addEventListener("DOMContentLoaded", function() {
                    let slides = document.querySelectorAll('.slide-item');
                    let currentSlide = 0;
                    setInterval(() => {
                        slides[currentSlide].style.opacity = '0';
                        slides[currentSlide].style.zIndex = '0';
                        currentSlide = (currentSlide + 1) % slides.length;
                        slides[currentSlide].style.opacity = '1';
                        slides[currentSlide].style.zIndex = '1';
                    }, 5000);
                });
            </script>
        <?php endif; ?>
    </div>
<?php else: ?>
    <!-- Hero section -->
    <section class="hero-pixel">
        <div class="hero-content">
            <h1 class="hero-title">
                CELEBRATING THE GRACE <br>OF TRADITION <br>
                <span class="gold">AND THE ENERGY <br>OF MOVEMENT</span>
            </h1>
            <p class="hero-subtitle">
                Dhrupodi Dancers' Association of KUET is a platform <br>
                where tradition meets passion and rhythm <br>
                creates memories.
            </p>
            <a href="/Dhrupodi/signup.php" class="btn-pill">
                Join Us Today 
                <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
            </a>
        </div>
    </section>
<?php endif; ?>


<section class="home-section">
    
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer left">
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer right">

    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            WHO WE ARE
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Our Passionate Community</h2>
        <p class="h-section-intro">We are a family of dancers, dreamers and creators.<br>United by our love for dance and dedicated to preserving culture.<br>Inspiring hearts and building unforgettable moments.</p>
    </div>

    <div class="about-cards-container">
        <div class="about-card">
            <div class="about-card-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/1754/1754291.png" alt="Masks">
            </div>
            <h3>Classical Dance</h3>
            <p>Preserving traditional dance forms and cultural heritage through dedicated practice and performances.</p>
        </div>
        <div class="about-card">
            <div class="about-card-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3074/3074064.png" alt="Stage">
            </div>
            <h3>Events & Performances</h3>
            <p>Organizing shows, festivals, and cultural programs throughout the year to spread the beauty of dance.</p>
        </div>
        <div class="about-card">
            <div class="about-card-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Community">
            </div>
            <h3>Community</h3>
            <p>Join our vibrant community of dancers and enthusiasts and be a part of something extraordinary.</p>
        </div>
    </div>
</section>


<section class="home-section home-dark-section">
    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            UPCOMING EVENTS
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Don't Miss Our Next Events</h2>
        <p class="h-section-intro">Join us in our journey of dance, culture and celebration.</p>
    </div>

    <div class="events-slider-wrapper">
        <div class="nav-arrow left"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg></div>
        
        <div class="events-grid">
            <?php foreach ($homeEvents as $event): ?>
            <div class="event-card-pixel">
                <div class="ec-date-strip">
                    <span class="ec-month"><?= date('M', strtotime($event['event_date'])) ?></span>
                    <span class="ec-day"><?= date('d', strtotime($event['event_date'])) ?></span>
                </div>
                <div class="ec-content">
                    <div class="ec-img">
                        <?php if($event['image_path']): ?>
                            <img src="/Dhrupodi/<?= htmlspecialchars($event['image_path']) ?>" alt="<?= htmlspecialchars($event['title']) ?>">
                        <?php else: ?>
                            <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="Event">
                        <?php endif; ?>
                    </div>
                    <div class="ec-info">
                        <h4><?= htmlspecialchars($event['title']) ?></h4>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> <?= htmlspecialchars($event['location'] ?? 'Venue TBA') ?></div>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg> <?= htmlspecialchars($event['event_time'] ?? 'Time TBA') ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($homeEvents)): ?>
                <div style="padding: 40px; text-align: center; color: var(--color-text-muted); width: 100%;">More exciting events coming soon!</div>
            <?php endif; ?>
        </div>

        <div class="nav-arrow right"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg></div>
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <a href="/Dhrupodi/events.php" class="btn-pill outline">
            View All Events &rarr;
        </a>
    </div>
</section>


<section class="home-section">
    
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer left">
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer right">

    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            MEDIA GALLERY
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Moments That Inspire</h2>
        <p class="h-section-intro">Glimpses from our performances, rehearsals and memorable moments.</p>
    </div>

    <div class="gallery-tabs">
        <div class="g-tab active">All</div>
        <div class="g-tab">Stage Performances</div>
        <div class="g-tab">Practice & Rehearsals</div>
        <div class="g-tab">Behind The Scenes</div>
        <div class="g-tab">Memorable Moments</div>
    </div>

    <div class="gallery-slider-wrapper">
        <div class="nav-arrow left"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg></div>
        
        <div class="gallery-row">
            <?php foreach ($homeGallery as $img): ?>
                <div class="g-img-box"><img src="/Dhrupodi/<?= htmlspecialchars($img['image_path']) ?>" alt="Gallery"></div>
            <?php endforeach; ?>
            <?php if (empty($homeGallery)): ?>
                <div style="padding: 40px; text-align: center; color: var(--color-text-muted); width: 100%;">Gallery updates coming soon.</div>
            <?php endif; ?>
        </div>

        <div class="nav-arrow right"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg></div>
    </div>

    <div style="text-align: center; margin-top: 40px; position: relative; z-index: 2;">
        <a href="/Dhrupodi/gallery.php" class="btn-pill outline" style="color: #0c2b18; border-color: rgba(0,0,0,0.1);">
            View All Events &rarr;
        </a>
    </div>
</section>


<section class="home-section" style="padding-top: 0;">
    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            OUR MEMBERS
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Meet Our Talented Members</h2>
        <p class="h-section-intro">The passionate people who lead, create and bring Dhrupodi to life.</p>
    </div>

    <div class="members-slider-wrapper">
        <div class="nav-arrow left" style="top: 40%;"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg></div>
        <div class="nav-arrow right" style="top: 40%;"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg></div>

        <h3 class="m-subtitle">Executive Committee</h3>
        <div class="m-grid-exec" style="margin-bottom: 40px;">
            <?php foreach ($homeMembers as $index => $m): if ($index >= 6) break; ?>
            <div class="m-card-pixel">
                <?php if($m['image_path']): ?>
                    <img src="/Dhrupodi/<?= htmlspecialchars($m['image_path']) ?>" onerror="this.src='/Dhrupodi/images/Homepage/home%20face.png'" alt="<?= htmlspecialchars($m['name']) ?>">
                <?php else: ?>
                    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="Member">
                <?php endif; ?>
                <div class="m-card-info"><h4><?= htmlspecialchars($m['name']) ?></h4><p><?= htmlspecialchars($m['role_title'] ?? 'Member') ?></p></div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($homeMembers)): ?>
                <div style="padding: 40px; text-align: center; color: var(--color-text-muted); width: 100%;">Members will be updated soon.</div>
            <?php endif; ?>
        </div>

        <?php if(count($homeMembers) > 6): ?>
        <h3 class="m-subtitle">Core Members</h3>
        <div class="m-grid-core">
            <?php foreach ($homeMembers as $index => $m): if ($index < 6) continue; if ($index >= 11) break; ?>
            <div class="m-card-pixel">
                <?php if($m['image_path']): ?>
                    <img src="/Dhrupodi/<?= htmlspecialchars($m['image_path']) ?>" onerror="this.src='/Dhrupodi/images/Homepage/home%20face.png'" alt="<?= htmlspecialchars($m['name']) ?>">
                <?php else: ?>
                    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="Member">
                <?php endif; ?>
                <div class="m-card-info"><h4><?= htmlspecialchars($m['name']) ?></h4><p><?= htmlspecialchars($m['role_title'] ?? 'Member') ?></p></div>
            </div>
            <?php endforeach; ?>
            <a href="/Dhrupodi/members.php" class="m-card-more">
                <span class="plus-num">+</span>
                <p>More Members</p>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <div style="text-align: center; margin-top: 40px; position: relative; z-index: 2;">
        <a href="/Dhrupodi/members.php" class="btn-pill outline" style="color: #0c2b18; border-color: rgba(0,0,0,0.1);">
            View All Members &rarr;
        </a>
    </div>
</section>


<section class="home-section home-dark-section" style="padding: 60px 20px;">
    <div class="h-section-header" style="margin-bottom: 40px;">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            OUR ACHIEVEMENTS
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title" style="font-size: 32px;">Milestones We're Proud Of</h2>
        <p class="h-section-intro">Every award, every moment is a step forward in our journey.</p>
    </div>

    <div class="achievements-grid">
        <?php foreach ($homeAchievements as $ach): ?>
        <div class="ach-box">
            <div class="ach-icon">
                <svg viewBox="0 0 24 24"><?= $ach['icon_svg'] ?></svg>
            </div>
            <div class="ach-num"><?= htmlspecialchars($ach['number_value']) ?></div>
            <div class="ach-label"><?= htmlspecialchars($ach['label']) ?></div>
        </div>
        <?php endforeach; ?>
        <?php if (empty($homeAchievements)): ?>
            <div style="grid-column: 1/-1; padding: 40px; text-align: center; color: var(--color-text-muted);">Milestones will be updated soon.</div>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'php/footer.php'; ?>
