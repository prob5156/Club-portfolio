<?php
$pageTitle = "Contact - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Get in touch with Dhrupodi Dancers' Association of KUET. Send us a message or find our contact details.";
$pageStylesheets = ['/Dhrupodi/css/pages/contact.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	
	<section id="contact" class="contact-section">
		<div class="content">
			<h2 class="page-title">Get In Touch</h2>
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