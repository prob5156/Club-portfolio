<?php
    if (!isset($globalSettings)) {
        $stmtSet = $pdo->query("SELECT setting_key, setting_value FROM website_settings");
        $globalSettings = $stmtSet->fetchAll(PDO::FETCH_KEY_PAIR);
    }
?>
    <footer id="footer" class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>About <?= htmlspecialchars($globalSettings['site_title'] ?? 'Dhrupodi') ?></h4>
                <p><?= htmlspecialchars($globalSettings['about_footer'] ?? 'A classical dance association dedicated to promoting and preserving traditional dance forms among KUET students.') ?></p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: <?= htmlspecialchars($globalSettings['contact_email'] ?? 'dhrupodi@kuet.ac.bd') ?></p>
                <p>Phone: <?= htmlspecialchars($globalSettings['contact_phone'] ?? '+880 1234-567890') ?></p>
                <p>Location: <?= htmlspecialchars($globalSettings['contact_address'] ?? 'KUET, Khulna') ?></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y'); ?> <?= htmlspecialchars($globalSettings['site_title'] ?? "Dhrupodi Dancers' Association of KUET") ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="/Dhrupodi/js/script.js"></script>

    
    <div class="floating-social-widget" id="socialWidget">
        <div class="social-menu-items" id="socialMenuItems">
            <?php if(!empty($globalSettings['facebook_url']) && $globalSettings['facebook_url'] !== '#'): ?>
            <a href="<?= htmlspecialchars($globalSettings['facebook_url']) ?>" target="_blank" class="social-btn" aria-label="Facebook">
                <svg viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
            </a>
            <?php endif; ?>
            <?php if(!empty($globalSettings['instagram_url']) && $globalSettings['instagram_url'] !== '#'): ?>
            <a href="<?= htmlspecialchars($globalSettings['instagram_url']) ?>" target="_blank" class="social-btn" aria-label="Instagram">
                <svg viewBox="0 0 24 24"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m4.4 4.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m0 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m5.3-3.1a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z"/></svg>
            </a>
            <?php endif; ?>
            <?php if(!empty($globalSettings['linkedin_url']) && $globalSettings['linkedin_url'] !== '#'): ?>
            <a href="<?= htmlspecialchars($globalSettings['linkedin_url']) ?>" target="_blank" class="social-btn" aria-label="LinkedIn">
                <svg viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
            </a>
            <?php endif; ?>
            <?php if(!empty($globalSettings['youtube_url']) && $globalSettings['youtube_url'] !== '#'): ?>
            <a href="<?= htmlspecialchars($globalSettings['youtube_url']) ?>" target="_blank" class="social-btn" aria-label="YouTube">
                <svg viewBox="0 0 24 24"><path d="M21.58 7.19c-.23-.86-.91-1.54-1.77-1.77C18.25 5 12 5 12 5s-6.25 0-7.81.42c-.86.23-1.54.91-1.77 1.77C2 8.75 2 12 2 12s0 3.25.42 4.81c.23.86.91 1.54 1.77 1.77C5.75 19 12 19 12 19s6.25 0 7.81-.42c.86-.23 1.54-.91 1.77-1.77C22 15.25 22 12 22 12s0-3.25-.42-4.81zM10 15V9l5.2 3z"/></svg>
            </a>
            <?php endif; ?>
            <a href="mailto:<?= htmlspecialchars($globalSettings['contact_email'] ?? 'dhrupodi@kuet.ac.bd') ?>" class="social-btn" aria-label="Email">
                <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            </a>
        </div>
        <button class="social-btn social-toggle-btn" id="socialToggleBtn" aria-label="Toggle Social Menu">
            <svg viewBox="0 0 24 24"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/></svg>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const socialWidget = document.getElementById('socialWidget');
            const socialToggleBtn = document.getElementById('socialToggleBtn');
            const socialMenuItems = document.getElementById('socialMenuItems');

            
            socialToggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                socialWidget.classList.toggle('active');
                socialMenuItems.classList.toggle('active');
            });

            
            document.addEventListener('click', (e) => {
                if (socialWidget.classList.contains('active') && !socialWidget.contains(e.target)) {
                    socialWidget.classList.remove('active');
                    socialMenuItems.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
