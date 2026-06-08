<?php
$pageTitle = "Dhrupodi Dancers' Association - KUET";
$pageDescription = "Welcome to Dhrupodi Dancers' Association of KUET - Celebrating the grace and tradition of classical dance at KUET.";
$pageStylesheets = ['/Dhrupodi/css/pages/home.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	<!-- Hero Section -->
	<section id="home" class="hero-section">
		<div class="hero-bg" aria-hidden="true"></div>
		<div class="hero-overlay" aria-hidden="true"></div>
		<div class="hero-inner">
			<div class="hero-particles" aria-hidden="true"></div>
			<div class="hero-content">
				<h1 class="hero-title"><span class="reveal">Welcome to</span> <strong class="brand">Dhrupodi</strong></h1>
				<p class="hero-sub">Preserving classical dance traditions and celebrating community at KUET.</p>
				<div class="hero-ctas">
					<a href="/Dhrupodi/contact.php" class="cta-btn primary">Join Us</a>
					<a href="/Dhrupodi/gallery.php" class="cta-btn secondary">Explore Gallery</a>
				</div>
			</div>

			<button class="scroll-down" aria-label="Scroll down" data-scroll-to="#about-us">
				<span class="arrow"></span>
				<span class="scroll-text">Explore</span>
			</button>
		</div>
	</section>

	<!-- Community Showcase Section -->
	<section id="about-us" class="community-showcase">
		<div class="community-overlay">
			<h2>Our Passionate Community</h2>
			<p>Meet the talented dancers and artists who bring Dhrupodi to life</p>
		</div>
	</section>

	<!-- Feature Cards Section -->
	<div id="gallery" class="content">
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

		<!-- Upcoming Events Section -->
		<section id="events" class="events-section">
			<h2>Upcoming Events</h2>
			<div class="events-list">
				<div class="event-card">
					<div class="event-date">May 15</div>
					<div class="event-details">
						<h4>Spring Performance</h4>
						<p>Main auditorium, KUET</p>
					</div>
				</div>
				<div class="event-card">
					<div class="event-date">June 1</div>
					<div class="event-details">
						<h4>Workshop Session</h4>
						<p>Dance studio, KUET</p>
					</div>
				</div>
				<div class="event-card">
					<div class="event-date">June 20</div>
					<div class="event-details">
						<h4>Annual Recital</h4>
						<p>Open air venue, KUET</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- Members Section -->
	<section id="members" class="members-section">
		<div class="content">
			<h2 style="text-align: center; color: #1a472a; margin-bottom: 2rem;">Our Members</h2>
			<p style="text-align: center; color: #666; margin-bottom: 2rem;">Our talented dancers and directors</p>
			<!-- Member profiles will be added here -->
		</div>
	</section>

	<!-- Contact Section -->
	<section id="contact" class="contact-section">
		<div class="content">
			<h2 style="text-align: center; color: #1a472a; margin-bottom: 2rem;">Get In Touch</h2>
			<div class="contact-form">
				<form>
					<input type="text" placeholder="Your Name" required>
					<input type="email" placeholder="Your Email" required>
					<textarea placeholder="Your Message" rows="5" required></textarea>
					<button type="submit" class="submit-btn">Send Message</button>
				</form>
			</div>
		</div>
	</section>

<?php require_once 'php/footer.php'; ?>