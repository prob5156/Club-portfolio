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

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && navbar.classList.contains('nav-open')) {
                closeMenu();
                toggleButton.focus();
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

    
    document.querySelectorAll('.cta-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const href = this.getAttribute('href') || '';
            const contactSection = document.getElementById('contact');
            if (href.indexOf('contact') > -1 && contactSection) {
                e.preventDefault();
                contactSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    
    const contactForm = document.querySelector('.contact-form form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your interest! We will get back to you soon.');
            this.reset();
        });
    }

    
    const hero = document.querySelector('.hero-pixel') || document.querySelector('.hero-section');
    const particlesContainer = document.querySelector('.hero-particles');
    const scrollBtn = document.querySelector('.scroll-down');

    if (hero) {
        
        setTimeout(() => hero.classList.add('hero-animate'), 180);

        
        if (particlesContainer) {
            const spawn = (count = 18) => {
                for (let i = 0; i < count; i++) {
                    const p = document.createElement('div');
                    p.className = 'particle';
                    const size = Math.round(6 + Math.random() * 28);
                    p.style.width = size + 'px';
                    p.style.height = size + 'px';
                    p.style.left = Math.random() * 100 + '%';
                    
                    p.style.top = 60 + Math.random() * 40 + '%';
                    const dur = 10 + Math.random() * 18;
                    p.style.animationDuration = dur + 's';
                    p.style.animationDelay = (Math.random() * 6) + 's';
                    p.style.opacity = (0.04 + Math.random() * 0.12).toFixed(2);
                    particlesContainer.appendChild(p);
                }
            };

            
            particlesContainer.innerHTML = '';
            spawn(20);
            
            setInterval(() => {
                particlesContainer.innerHTML = '';
                spawn(18 + Math.round(Math.random() * 8));
            }, 22000);
        }

        
        if (scrollBtn) {
            scrollBtn.addEventListener('click', function() {
                const target = this.getAttribute('data-scroll-to') || '#about-us';
                const el = document.querySelector(target);
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            });
        }

        
        const revealTargets = [].slice.call(document.querySelectorAll('.reveal-section, .feature-card'));
        if (revealTargets.length && 'IntersectionObserver' in window) {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            revealTargets.forEach(t => obs.observe(t));
        } else {
            
            revealTargets.forEach(t => t.classList.add('is-visible'));
        }
    }

});
