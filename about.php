<?php
$pageTitle = "About Us - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Learn about Dhrupodi Dancers' Association of KUET - our passionate community dedicated to classical dance and cultural heritage.";
$pageStylesheets = ['/Dhrupodi/css/pages/about.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	<section id="about-us" class="about-hero reveal-section">
		<div class="content about-hero-inner">
			<p class="section-kicker">About Dhrupodi</p>
			<h1 class="page-title">Our Passionate Community</h1>
			<p class="page-intro">Meet the talented dancers and artists who bring Dhrupodi to life through classical form, disciplined practice, and shared tradition.</p>
		</div>
	</section>

	<div id="gallery" class="content about-content reveal-section">
		<div class="features-container about-features">
			<div class="feature-card">
				<div class="card-icon">🎭</div>
				<h3>Classical Dance</h3>
				<p>Preserving traditional dance forms and cultural heritage with attentive practice and performance.</p>
			</div>
			<div class="feature-card">
				<div class="card-icon">🎪</div>
				<h3>Events &amp; Performances</h3>
				<p>Regular shows and cultural programs throughout the year, crafted to feel alive and welcoming.</p>
			</div>
			<div class="feature-card">
				<div class="card-icon">👥</div>
				<h3>Community</h3>
				<p>A supportive group of dancers, organizers, and alumni shaping the experience together.</p>
			</div>
		</div>
	</div>

<?php require_once 'php/footer.php'; ?>