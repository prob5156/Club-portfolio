    <?php
    require_once __DIR__ . '/../config/auth.php';
    $currentPage = basename($_SERVER['PHP_SELF']);

    $navItems = [
        'index.php' => 'Home',
        'about.php' => 'About',
        'members.php' => 'Members',
        'events.php' => 'Events',
        'gallery.php' => 'Gallery',
        'contact.php' => 'Contact',
    ];
    
    if (isLoggedIn()) {
        $dashboardLink = (getUserRole() === 'admin') ? 'admin/index.php' : 'member/index.php';
        $navItems[$dashboardLink] = 'Dashboard';
        $navItems['logout.php'] = 'Logout';
    } else {
        $navItems['signup.php'] = 'Join Us';
        $navItems['login.php'] = 'Login';
    }
    ?>
    <nav class="navbar" data-navbar aria-label="Primary navigation">
        <div class="logo-section">
            <img src="https://graph.facebook.com/dhrupodidancerskuet/picture?type=large" alt="Dhrupodi Logo" class="navbar-logo">
            <h1 class="site-title">Dhrupodi Dancers'<br><span class="subtitle">Association of KUET</span></h1>
        </div>

        <button class="nav-toggle" type="button" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="primary-navigation">
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

        <input type="text" class="search-bar" placeholder="Search events..." aria-label="Search events">
    </nav>
