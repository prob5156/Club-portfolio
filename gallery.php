<?php
$pageTitle = "Gallery - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Browse the gallery of Dhrupodi Dancers' Association of KUET - classical dance performances, events, and community moments.";
$pageStylesheets = ['/Dhrupodi/css/pages/gallery.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	<!-- Gallery Section -->
	<div id="gallery" class="content">
		<h2 class="page-title">Our Gallery</h2>
		<p class="page-intro">Moments captured from our performances and events</p>
		<div class="features-container">
			<div class="feature-card">
				<div class="card-icon">🎭</div>
				<h3>Classical Dance</h3>
				<p>Preserving traditional dance forms and cultural heritage</p>
			</div>
			<div class="feature-card">
				<div class="card-icon">🎪</div>
				<h3>Events &amp; Performances</h3>
				<p>Regular shows and cultural programs throughout the year</p>
			</div>
			<div class="feature-card">
				<div class="card-icon">👥</div>
				<h3>Community</h3>
				<p>Join our vibrant dance community at KUET</p>
			</div>
		</div>
	</div>

<?php require_once 'php/footer.php'; ?>