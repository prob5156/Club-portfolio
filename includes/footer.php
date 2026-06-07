    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>About Dhrupodi</h4>
                <p>A classical dance association dedicated to promoting and preserving traditional dance forms among KUET students.</p>
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
                <p>Email: dhrupodi@kuet.ac.bd</p>
                <p>Location: KUET, Khulna</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Dhrupodi Dancers' Association of KUET. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Navigation smooth scroll for same-page anchors
        document.querySelectorAll('a.nav-btn[href^="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    e.preventDefault();
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Join Us button
        const ctaBtn = document.querySelector('.cta-btn');
        if (ctaBtn) {
            ctaBtn.addEventListener('click', function() {
                const contactSection = document.getElementById('contact');
                if (contactSection) {
                    contactSection.scrollIntoView({ behavior: 'smooth' });
                } else {
                    window.location.href = 'contact.php';
                }
            });
        }

        // Contact form submission
        const contactForm = document.querySelector('.contact-form form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Thank you for your interest! We will get back to you soon.');
                this.reset();
            });
        }
    </script>

</body>
</html>
