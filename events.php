<?php
$pageTitle = "Events - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Upcoming events and performances by Dhrupodi Dancers' Association of KUET - workshops, recitals, and cultural programs.";
$pageStylesheets = ['/Dhrupodi/css/pages/events.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	<div class="content">
		
		<section id="upcoming-events" class="events-section">
			<h2>Upcoming Events</h2>
			<div class="events-list" style="display: block; text-align: center; color: var(--color-text-muted); padding: 2rem 0;">
				<p>We are currently planning our next exciting performances. Check back soon!</p>
			</div>
		</section>

		
		<section id="past-events" class="events-section" style="margin-top: 4rem;">
			<h2>Past Events</h2>
			<div class="events-list">
				
				
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
						<a href="#" class="event-btn">View Gallery</a>
					</div>
				</div>

				
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
						<a href="#" class="event-btn">View Gallery</a>
					</div>
				</div>

				
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
						<a href="#" class="event-btn">View Gallery</a>
					</div>
				</div>

			</div>
		</section>
	</div>

<?php require_once 'php/footer.php'; ?>