<?php
// contact.php
require_once __DIR__ . '/config/database.php';

$successMsg = '';
$errorMsg = '';

/* process contact form submission */
// Check post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // basic validation
    if (!$name || !$email || !$subject || !$message) {
        $errorMsg = "Please fill in all required fields.";
    } else {
        if ($phone) {
            $message = "Phone: " . $phone . "\n\n" . $message;
        }
        try {
            // insert to db
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message, status) VALUES (?, ?, ?, ?, 'unread')");
            $stmt->execute([$name, $email, $subject, $message]);
            $successMsg = "Your message has been sent successfully! We will get back to you soon.";
        } catch (Exception $e) {
            $errorMsg = "Something went wrong. Please try again later.";
        }
    }
}

$pageTitle = "Contact - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Get in touch with Dhrupodi Dancers' Association of KUET. Send us a message or find our contact details.";
$pageStylesheets = ['/Dhrupodi/css/pages/contact.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

<div class="contact-hero">
    <h1 class="hero-title">CONTACT US</h1>
    <div class="hero-divider">
        <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
    </div>
    <!-- Hero section -->
    <div class="hero-subtitle">Let's Create Something Beautiful Together</div>
</div>

<section class="contact-body">
    <div class="contact-grid">
        
        <div class="c-card reveal-section">
            <h2 class="c-card-title">GET IN TOUCH</h2>
            <div class="c-divider">
                <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </div>
                <div class="info-content">
                    <span class="info-label">Email</span>
                    <span class="info-text">dhrupodi@kuet.ac.bd</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                </div>
                <div class="info-content">
                    <span class="info-label">Phone</span>
                    <span class="info-text">+880 1234-567890</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <div class="info-content">
                    <span class="info-label">Address</span>
                    <span class="info-text">KUET Campus<br>Khulna, Bangladesh</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                </div>
                <div class="info-content">
                    <span class="info-label">Office Hours</span>
                    <span class="info-text">Sunday - Thursday<br>10:00 AM - 5:00 PM</span>
                </div>
            </div>

            <div class="social-section">
                <h3 class="c-card-title" style="font-size: 18px;">FOLLOW US</h3>
                <div class="c-divider" style="margin-bottom: 20px;">
                    <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
                </div>
                <div class="social-icons">
                    <a href="#" class="social-circle">
                        <svg viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                    </a>
                    <a href="#" class="social-circle">
                        <svg viewBox="0 0 24 24"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m4.4 4.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m0 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m5.3-3.1a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z"/></svg>
                    </a>
                    <a href="#" class="social-circle">
                        <svg viewBox="0 0 24 24"><path d="M21.58 7.19c-.23-.86-.91-1.54-1.77-1.77C18.25 5 12 5 12 5s-6.25 0-7.81.42c-.86.23-1.54.91-1.77 1.77C2 8.75 2 12 2 12s0 3.25.42 4.81c.23.86.91 1.54 1.77 1.77C5.75 19 12 19 12 19s6.25 0 7.81-.42c.86-.23 1.54-.91 1.77-1.77C22 15.25 22 12 22 12s0-3.25-.42-4.81zM10 15V9l5.2 3z"/></svg>
                    </a>
                    <a href="#" class="social-circle">
                        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="c-card reveal-section">
            <h2 class="c-card-title">SEND US A MESSAGE</h2>
            <div class="c-divider">
                <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            </div>
            
            <?php if ($successMsg): ?>
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                    <?= htmlspecialchars($successMsg) ?>
                </div>
            <?php endif; ?>
            <?php if ($errorMsg): ?>
                <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                    <?= htmlspecialchars($errorMsg) ?>
                </div>
            <?php endif; ?>

            <form class="c-form" method="POST" action="">
                <div class="form-group">
                    <input type="text" name="name" class="c-input" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="c-input" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="c-input" placeholder="Your Phone">
                </div>
                <div class="form-group">
                    <input type="text" name="subject" class="c-input" placeholder="Subject" required>
                </div>
                <div class="form-group full-width">
                    <textarea name="message" class="c-input" placeholder="Your Message" required rows="5"></textarea>
                </div>
                <button type="submit" class="c-submit">
                    SEND MESSAGE
                    <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

<section class="contact-cta reveal-section" style="margin-top: -30px; margin-bottom: 50px; position: relative; z-index: 2;">
    <h2 class="cta-title">Become a Part of Dhrupodi</h2>
    <p class="cta-subtitle">Dance. Culture. Passion.</p>
    <a href="members.php" class="cta-btn">
        JOIN US TODAY
        <svg viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
    </a>
</section>

<?php require_once 'php/footer.php'; ?>