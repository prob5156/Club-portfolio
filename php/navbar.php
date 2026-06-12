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
    <?php
    if (!isset($globalSettings)) {
        $stmtSet = $pdo->query("SELECT setting_key, setting_value FROM website_settings");
        $globalSettings = $stmtSet->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    $siteTitle = $globalSettings['site_title'] ?? "Dhrupodi Dancers' Association";
    // Optional: Extract subtitle if present using a simple logic, e.g., splitting by ' - ' or just using the full title
    $titleParts = explode(' - ', $siteTitle, 2);
    ?>
    <!-- Navbar -->
    <nav class="navbar" data-navbar aria-label="Primary navigation">
        <div class="logo-section">
            <img src="https://graph.facebook.com/dhrupodidancerskuet/picture?type=large" alt="Dhrupodi Logo" class="navbar-logo">
            <h1 class="site-title"><?= htmlspecialchars($titleParts[0]) ?><?php if(isset($titleParts[1])): ?><br><span class="subtitle"><?= htmlspecialchars($titleParts[1]) ?></span><?php endif; ?></h1>
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
