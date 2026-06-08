document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('[data-navbar]');
    const toggleButton = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (navbar && toggleButton && navLinks) {
        const closeMenu = () => {
            navbar.classList.remove('nav-open');
            toggleButton.setAttribute('aria-expanded', 'false');
        };

        toggleButton.addEventListener('click', function() {
            const isOpen = navbar.classList.toggle('nav-open');
            toggleButton.setAttribute('aria-expanded', String(isOpen));
        });

        navLinks.querySelectorAll('.nav-btn').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('click', function(event) {
            if (navbar.classList.contains('nav-open') && !navbar.contains(event.target)) {
                closeMenu();
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                closeMenu();
            }
        });

        const updateScrolledState = () => {
            navbar.classList.toggle('is-scrolled', window.scrollY > 8);
        };

        updateScrolledState();
        window.addEventListener('scroll', updateScrolledState, { passive: true });
    }

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
});
