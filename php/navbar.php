    <!-- Navigation Bar -->
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);

    $navItems = [
        'index.php' => 'Home',
        'about.php' => 'About Us',
        'gallery.php' => 'Gallery',
        'events.php' => 'Events',
        'members.php' => 'Members',
        'contact.php' => 'Contact',
    ];
    ?>
    <nav class="navbar" data-navbar>
        <div class="logo-section">
            <img src="https://graph.facebook.com/dhrupodidancerskuet/picture?type=large" alt="Dhrupodi Logo" class="navbar-logo">
            <h1 class="site-title">Dhrupodi Dancers'<br><span class="subtitle">Association of KUET</span></h1>
        </div>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
            <span class="nav-toggle-lines" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="nav-toggle-text">Menu</span>
        </button>

        <div class="nav-links" id="primary-navigation">
            <?php foreach ($navItems as $fileName => $label): ?>
                <a href="/Dhrupodi/<?php echo $fileName; ?>" class="nav-btn<?php echo $currentPage === $fileName ? ' active' : ''; ?>">
                    <?php echo $label; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <input type="text" class="search-bar" placeholder="Search events...">
    </nav>
