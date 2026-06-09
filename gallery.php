<?php
$pageTitle = "Gallery - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Browse the gallery of Dhrupodi Dancers' Association of KUET - classical dance performances, events, and community moments.";
$pageStylesheets = ['/Dhrupodi/css/pages/gallery.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

	<section id="gallery" class="content gallery-page">
		<div class="gallery-header">
			<p class="section-kicker">Gallery</p>
			<h1 class="page-title">Our Gallery</h1>
			<p class="page-intro">Moments captured from our performances and events.</p>
		</div>

		<div class="gallery-grid" role="list" aria-label="Gallery photos">
			<?php
			$items = [
				['src' => '/Dhrupodi/images/dhrupodi-screenshot.png', 'title' => 'Grace in Motion', 'caption' => 'Performance highlights and stage photos.'],
				['src' => '/Dhrupodi/images/dhrupodi-screenshot.png', 'title' => 'Rehearsal', 'caption' => 'Behind-the-scenes rehearsal moments.'],
				['src' => '/Dhrupodi/images/dhrupodi-screenshot.png', 'title' => 'Community', 'caption' => 'Members and collaborators.'],
				['src' => '/Dhrupodi/images/dhrupodi-screenshot.png', 'title' => 'Events', 'caption' => 'Special events and workshops.'],
				['src' => '/Dhrupodi/images/dhrupodi-screenshot.png', 'title' => 'Stage', 'caption' => 'Lighting and choreography frames.'],
				['src' => '/Dhrupodi/images/dhrupodi-screenshot.png', 'title' => 'Portraits', 'caption' => 'Artistic portraits of dancers.'],
			];

			foreach ($items as $it): ?>
				<figure class="gallery-item">
					<img src="<?php echo htmlspecialchars($it['src']); ?>" alt="<?php echo htmlspecialchars($it['title']); ?>" loading="lazy">
					<figcaption class="gallery-caption">
						<strong><?php echo htmlspecialchars($it['title']); ?></strong>
						<span><?php echo htmlspecialchars($it['caption']); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</section>

<?php require_once 'php/footer.php'; ?>