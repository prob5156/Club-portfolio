<?php
$pageTitle = "Dhrupodi Dancers' Association - KUET";
$pageDescription = "Welcome to Dhrupodi Dancers' Association of KUET - Celebrating the grace and diversity of dance at KUET.";
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
				<p class="hero-sub">Exploring diverse dance forms and celebrating community at KUET.</p>
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
	<section id="about-us" class="community-showcase reveal-section">
		<div class="community-overlay">
			<h2>Our Passionate Community</h2>
			<p>Meet the talented dancers and artists who bring Dhrupodi to life</p>
		</div>
	</section>

	<!-- Feature Cards Section -->
	<div id="gallery" class="content reveal-section">
		<div class="features-container">
			<div class="feature-card">
				<div class="card-icon">🎭</div>
				<h3>Versatile Dance Styles</h3>
				<p>Exploring contemporary, traditional, and all cultural dance forms</p>
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
		<section id="events" class="events-section reveal-section">
			<h2>Upcoming Events</h2>
			<div class="events-list" style="display: block; text-align: center; color: var(--color-text-muted); padding: 2rem 0;">
				<p>We are currently planning our next exciting performances. Check back soon!</p>
			</div>
		</section>

		<!-- Past Events Section -->
		<section id="past-events" class="events-section reveal-section" style="margin-top: 4rem;">
			<h2>Past Events</h2>
			<div class="events-list">
				
				<!-- Event Card 1 -->
				<div class="event-card">
					<div class="event-image">
						<img src="/Dhrupodi/images/Event 1.jpg" alt="Spring Performance">
						<div class="event-date-badge">
							<span>15</span> May
						</div>
					</div>
					<div class="event-details">
						<span class="event-tag">Performance</span>
						<h4>Spring Performance</h4>
						<p>Join us for our annual spring festival celebration featuring a versatile mix of dance pieces.</p>
						<div class="event-meta">
							<span>
								<svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
								Main Auditorium, KUET
							</span>
						</div>
						<a href="/Dhrupodi/events.php" class="event-btn">View Details</a>
					</div>
				</div>

				<!-- Event Card 2 -->
				<div class="event-card">
					<div class="event-image">
						<img src="/Dhrupodi/images/Event 2.jpg" alt="Workshop Session">
						<div class="event-date-badge">
							<span>01</span> Jun
						</div>
					</div>
					<div class="event-details">
						<span class="event-tag">Workshop</span>
						<h4>Workshop Session</h4>
						<p>A deep dive into various dance expressions and footwork with renowned instructors.</p>
						<div class="event-meta">
							<span>
								<svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
								Dance Studio, KUET
							</span>
						</div>
						<a href="/Dhrupodi/events.php" class="event-btn">View Details</a>
					</div>
				</div>

				<!-- Event Card 3 -->
				<div class="event-card">
					<div class="event-image">
						<img src="/Dhrupodi/images/Event 3.jpg" alt="Annual Recital">
						<div class="event-date-badge">
							<span>20</span> Jun
						</div>
					</div>
					<div class="event-details">
						<span class="event-tag">Recital</span>
						<h4>Annual Recital</h4>
						<p>Our grandest event of the year showcasing the hard work and dedication of all our members.</p>
						<div class="event-meta">
							<span>
								<svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
								Open Air Venue, KUET
							</span>
						</div>
						<a href="/Dhrupodi/events.php" class="event-btn">View Details</a>
					</div>
				</div>

			</div>
		</section>
	</div>

	<!-- Members Section -->
	<section id="members" class="members-section reveal-section">
		<div class="content">
			<h2>Our Leaders</h2>
			<p>Meet the dedicated individuals who lead Dhrupodi</p>
			
			<div class="members-grid" style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
				<!-- President -->
				<div class="member-card" onclick="window.location.href='/Dhrupodi/members.php'">
					<div class="member-image">
						<img src="/Dhrupodi/images/President.jpg" alt="President">
					</div>
					<div class="member-info">
						<h3>Member Name</h3>
						<span class="member-role">President</span>
						<button class="view-profile-btn">View Profile &rarr;</button>
					</div>
				</div>

				<!-- General Secretary -->
				<div class="member-card" onclick="window.location.href='/Dhrupodi/members.php'">
					<div class="member-image">
						<img src="/Dhrupodi/images/General Secretary.jpg" alt="General Secretary">
					</div>
					<div class="member-info">
						<h3>Member Name</h3>
						<span class="member-role">General Secretary</span>
						<button class="view-profile-btn">View Profile &rarr;</button>
					</div>
				</div>
			</div>
			
			<div style="text-align: center; margin-top: 3rem;">
				<a href="/Dhrupodi/members.php" class="cta-btn primary" style="display: inline-block; text-decoration: none;">View All Members</a>
			</div>
		</div>
	</section>

	<!-- Contact Section -->
	<section id="contact" class="contact-section reveal-section">
		<div class="content">
			<h2>Get In Touch</h2>
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