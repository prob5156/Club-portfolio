<?php
$pageTitle = "About Us - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Learn about Dhrupodi Dancers' Association of KUET - our passionate community dedicated to classical dance and cultural heritage.";
$pageStylesheets = ['/Dhrupodi/css/pages/about.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

<div class="about-hero">
    <div class="hero-overlay"></div>
    <div class="content about-hero-inner reveal-section">
        <h1 class="hero-title">ABOUT US</h1>
        <div class="hero-separator">
            <svg viewBox="0 0 100 10" width="80" height="12"><path d="M50 0L55 5L100 5L100 6L55 6L50 10L45 6L0 6L0 5L45 5Z" fill="#D4AF37"/></svg>
        </div>
        <!-- Hero section -->
        <p class="hero-subtitle">UNITED BY PASSION, DRIVEN BY TRADITION</p>
    </div>
</div>

<section class="who-we-are">
    <div class="content wwa-container reveal-section">
        <div class="wwa-image-wrapper">
            <img src="/Dhrupodi/images/About%20US/Everyone.jpg" alt="Dhrupodi Family" class="wwa-image">
        </div>
        <div class="wwa-content">
            <div class="section-kicker">
                <span class="kicker-line"></span> WHO WE ARE
            </div>
            <h2 class="wwa-title">A Community of Dancers,<br>Creators & Culture Lovers</h2>
            <p>Dhrupodi Dancers' Association of KUET is more than just a dance organization—it is a family bound by love for the art, culture, and traditions of Bangladesh.</p>
            <p>We strive to promote classical and cultural dance, inspire creativity, and preserve our rich heritage for future generations.</p>
            <a href="/Dhrupodi/about.php" class="btn-outline-gold">Learn More About Us <span class="btn-arrow">&gt;</span></a>
        </div>
    </div>
</section>

<section class="our-values">
    <div class="content reveal-section">
        <div class="values-header">
            <div class="section-kicker centered">
                WHAT WE STAND FOR <span class="kicker-line right"></span>
            </div>
            <h2 class="values-title">Our Values</h2>
        </div>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="v-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="#D4AF37"><path d="M2 21h20v-2H2v2zm2-4h2V7H4v10zm4 0h2V7H8v10zm4 0h2V7h-2v10zm4 0h2V7h-2v10zM2 5v2h20V5l-10-3-10 3z"/></svg>
                </div>
                <h3>TRADITION</h3>
                <p>We honor our roots and cherish the richness of our cultural heritage.</p>
            </div>
            <div class="value-card">
                <div class="v-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="#D4AF37"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
                <h3>UNITY</h3>
                <p>We work together as a family, supporting and uplifting each other.</p>
            </div>
            <div class="value-card">
                <div class="v-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="#D4AF37"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                </div>
                <h3>EXCELLENCE</h3>
                <p>We strive for the highest standard in every performance.</p>
            </div>
            <div class="value-card">
                <div class="v-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="#D4AF37"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <h3>RESPECT</h3>
                <p>We respect our art, our culture, and every individual.</p>
            </div>
            <div class="value-card">
                <div class="v-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="#D4AF37"><path d="M9 21c0 .5.4 1 1 1h4c.6 0 1-.5 1-1v-1H9v1zm3-19C8.1 2 5 5.1 5 9c0 2.4 1.2 4.5 3 5.7V17c0 .5.4 1 1 1h6c.6 0 1-.5 1-1v-2.3c1.8-1.3 3-3.4 3-5.7 0-3.9-3.1-7-7-7z"/></svg>
                </div>
                <h3>INNOVATION</h3>
                <p>We embrace creativity and continuously evolve while staying true to tradition.</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'php/footer.php'; ?>