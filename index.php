<?php
$pageTitle = "Dhrupodi Dancers' Association - KUET";
$pageDescription = "Welcome to Dhrupodi Dancers' Association of KUET - Celebrating the grace of tradition and the energy of movement.";
$pageStylesheets = ['/Dhrupodi/css/pages/home.css']; 
require_once 'php/header.php';
require_once 'php/navbar.php';
?>

<script>
    document.body.classList.add('home-page');
</script>


<section class="hero-pixel">
    <div class="hero-content">
        <h1 class="hero-title">
            CELEBRATING THE GRACE <br>OF TRADITION <br>
            <span class="gold">AND THE ENERGY <br>OF MOVEMENT</span>
        </h1>
        <p class="hero-subtitle">
            Dhrupodi Dancers' Association of KUET is a platform <br>
            where tradition meets passion and rhythm <br>
            creates memories.
        </p>
        <a href="/Dhrupodi/contact.php" class="btn-pill">
            Join Us Today 
            <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
        </a>
    </div>
</section>


<section class="home-section">
    
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer left">
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer right">

    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            WHO WE ARE
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Our Passionate Community</h2>
        <p class="h-section-intro">We are a family of dancers, dreamers and creators.<br>United by our love for dance and dedicated to preserving culture.<br>Inspiring hearts and building unforgettable moments.</p>
    </div>

    <div class="about-cards-container">
        <div class="about-card">
            <div class="about-card-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/1754/1754291.png" alt="Masks">
            </div>
            <h3>Classical Dance</h3>
            <p>Preserving traditional dance forms and cultural heritage through dedicated practice and performances.</p>
        </div>
        <div class="about-card">
            <div class="about-card-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3074/3074064.png" alt="Stage">
            </div>
            <h3>Events & Performances</h3>
            <p>Organizing shows, festivals, and cultural programs throughout the year to spread the beauty of dance.</p>
        </div>
        <div class="about-card">
            <div class="about-card-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Community">
            </div>
            <h3>Community</h3>
            <p>Join our vibrant community of dancers and enthusiasts and be a part of something extraordinary.</p>
        </div>
    </div>
</section>


<section class="home-section home-dark-section">
    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            UPCOMING EVENTS
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Don't Miss Our Next Events</h2>
        <p class="h-section-intro">Join us in our journey of dance, culture and celebration.</p>
    </div>

    <div class="events-slider-wrapper">
        <div class="nav-arrow left"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg></div>
        
        <div class="events-grid">
            <div class="event-card-pixel">
                <div class="ec-date-strip"><span class="ec-month">MAY</span><span class="ec-day">15</span></div>
                <div class="ec-content">
                    <div class="ec-img"><img src="/Dhrupodi/images/Event%201.jpg" alt="Event 1"></div>
                    <div class="ec-info">
                        <h4>Spring Performance</h4>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> Main Auditorium, KUET</div>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg> 6:00 PM</div>
                    </div>
                </div>
            </div>
            <div class="event-card-pixel">
                <div class="ec-date-strip"><span class="ec-month">JUN</span><span class="ec-day">01</span></div>
                <div class="ec-content">
                    <div class="ec-img"><img src="/Dhrupodi/images/Event%202.jpg" alt="Event 2"></div>
                    <div class="ec-info">
                        <h4>Workshop Session</h4>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> Dance Studio, KUET</div>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg> 4:00 PM</div>
                    </div>
                </div>
            </div>
            <div class="event-card-pixel">
                <div class="ec-date-strip"><span class="ec-month">JUN</span><span class="ec-day">20</span></div>
                <div class="ec-content">
                    <div class="ec-img"><img src="/Dhrupodi/images/Event%203.jpg" alt="Event 3"></div>
                    <div class="ec-info">
                        <h4>Annual Recital</h4>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> Open Air Venue, KUET</div>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg> 6:30 PM</div>
                    </div>
                </div>
            </div>
            <div class="event-card-pixel">
                <div class="ec-date-strip"><span class="ec-month">JUL</span><span class="ec-day">10</span></div>
                <div class="ec-content">
                    <div class="ec-img"><img src="/Dhrupodi/images/Event%201.jpg" alt="Event 4"></div>
                    <div class="ec-info">
                        <h4>Cultural Exchange</h4>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> KUET Campus</div>
                        <div class="ec-meta"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg> 5:00 PM</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav-arrow right"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg></div>
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <a href="/Dhrupodi/events.php" class="btn-pill outline">
            View All Events &rarr;
        </a>
    </div>
</section>


<section class="home-section">
    
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer left">
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer right">

    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            MEDIA GALLERY
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Moments That Inspire</h2>
        <p class="h-section-intro">Glimpses from our performances, rehearsals and memorable moments.</p>
    </div>

    <div class="gallery-tabs">
        <div class="g-tab active">All</div>
        <div class="g-tab">Stage Performances</div>
        <div class="g-tab">Practice & Rehearsals</div>
        <div class="g-tab">Behind The Scenes</div>
        <div class="g-tab">Memorable Moments</div>
    </div>

    <div class="gallery-slider-wrapper">
        <div class="nav-arrow left"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg></div>
        
        <div class="gallery-row">
            <div class="g-img-box"><img src="/Dhrupodi/images/Event%201.jpg" alt="Gallery"></div>
            <div class="g-img-box"><img src="/Dhrupodi/images/Event%202.jpg" alt="Gallery"></div>
            <div class="g-img-box"><img src="/Dhrupodi/images/Event%203.jpg" alt="Gallery"></div>
            <div class="g-img-box"><img src="/Dhrupodi/images/Event%201.jpg" alt="Gallery"></div>
            <div class="g-img-box"><img src="/Dhrupodi/images/Event%202.jpg" alt="Gallery"></div>
        </div>

        <div class="nav-arrow right"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg></div>
    </div>

    <div style="text-align: center; margin-top: 40px; position: relative; z-index: 2;">
        <a href="/Dhrupodi/gallery.php" class="btn-pill outline" style="color: #0c2b18; border-color: rgba(0,0,0,0.1);">
            View All Events &rarr;
        </a>
    </div>
</section>


<section class="home-section" style="padding-top: 0;">
    <div class="h-section-header">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            OUR MEMBERS
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title">Meet Our Talented Members</h2>
        <p class="h-section-intro">The passionate people who lead, create and bring Dhrupodi to life.</p>
    </div>

    <div class="members-slider-wrapper">
        <div class="nav-arrow left" style="top: 40%;"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg></div>
        <div class="nav-arrow right" style="top: 40%;"><svg viewBox="0 0 24 24" width="20" height="20"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg></div>

        <h3 class="m-subtitle">Executive Committee</h3>
        <div class="m-grid-exec" style="margin-bottom: 40px;">
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/President.jpg" onerror="this.src='/Dhrupodi/images/member1.jpg'" alt="President">
                <div class="m-card-info"><h4>Raihan Ahmed</h4><p>President</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/Vice-President.jpg" onerror="this.src='/Dhrupodi/images/member2.jpg'" alt="VP">
                <div class="m-card-info"><h4>Nusrat Jahan</h4><p>Vice President</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/General%20Secretary.jpg" onerror="this.src='/Dhrupodi/images/member3.jpg'" alt="GS">
                <div class="m-card-info"><h4>Sabbir Hossain</h4><p>General Secretary</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/Assistant%20Genaral%20Secratary.jpg" onerror="this.src='/Dhrupodi/images/member4.jpg'" alt="JS">
                <div class="m-card-info"><h4>Noumita Sarkar</h4><p>Joint Secretary</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/Organising%20Secretary.jpg" onerror="this.src='/Dhrupodi/images/member5.jpg'" alt="Treasurer">
                <div class="m-card-info"><h4>Fahim Rahman</h4><p>Treasurer</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/Organising%20Secretary%202.jpg" onerror="this.src='/Dhrupodi/images/member6.jpg'" alt="CS">
                <div class="m-card-info"><h4>Tasmia Ahmed</h4><p>Cultural Secretary</p></div>
            </div>
        </div>

        <h3 class="m-subtitle">Core Members</h3>
        <div class="m-grid-core">
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/member1.jpg" alt="Member">
                <div class="m-card-info"><h4>Adib Hossain</h4><p>Member</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/member2.jpg" alt="Member">
                <div class="m-card-info"><h4>Ishrat Jahan</h4><p>Member</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/member3.jpg" alt="Member">
                <div class="m-card-info"><h4>Mehedi Hasan</h4><p>Member</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/member4.jpg" alt="Member">
                <div class="m-card-info"><h4>Anika Islam</h4><p>Member</p></div>
            </div>
            <div class="m-card-pixel">
                <img src="/Dhrupodi/images/member5.jpg" alt="Member">
                <div class="m-card-info"><h4>Tanvir Ahmed</h4><p>Member</p></div>
            </div>
            <a href="/Dhrupodi/members.php" class="m-card-more">
                <span class="plus-num">+25</span>
                <p>More Members</p>
            </a>
        </div>
    </div>

    <div style="text-align: center; margin-top: 40px; position: relative; z-index: 2;">
        <a href="/Dhrupodi/members.php" class="btn-pill outline" style="color: #0c2b18; border-color: rgba(0,0,0,0.1);">
            View All Members &rarr;
        </a>
    </div>
</section>


<section class="home-section home-dark-section" style="padding: 60px 20px;">
    <div class="h-section-header" style="margin-bottom: 40px;">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            OUR ACHIEVEMENTS
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
        <h2 class="h-section-title" style="font-size: 32px;">Milestones We're Proud Of</h2>
        <p class="h-section-intro">Every award, every moment is a step forward in our journey.</p>
    </div>

    <div class="achievements-grid">
        <div class="ach-box">
            <div class="ach-icon">
                <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 9h-2V7h-2v5H6v-2h2V7c0-1.1.9-2 2-2h2v7zm4 0h-2V7h-2v5h-2v-2h2V7c0-1.1.9-2 2-2h2v7z"/></svg>
            </div>
            <div class="ach-num">25+</div>
            <div class="ach-label">Events Organized</div>
        </div>
        <div class="ach-box">
            <div class="ach-icon">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div class="ach-num">150+</div>
            <div class="ach-label">Active Members</div>
        </div>
        <div class="ach-box">
            <div class="ach-icon">
                <svg viewBox="0 0 24 24"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 0 0 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM7 10.82C5.84 10.4 5 9.3 5 8V7h2v3.82zM19 8c0 1.3-.84 2.4-2 2.82V7h2v1z"/></svg>
            </div>
            <div class="ach-num">15+</div>
            <div class="ach-label">Awards Won</div>
        </div>
        <div class="ach-box">
            <div class="ach-icon">
                <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>
            </div>
            <div class="ach-num">10+</div>
            <div class="ach-label">Years of Journey</div>
        </div>
    </div>
</section>


<section class="home-section">
    
    <img src="/Dhrupodi/images/Homepage/home%20face.png" alt="" class="bg-dancer right">

    <div class="h-section-header" style="margin-bottom: 40px;">
        <div class="h-section-kicker">
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
            GET IN TOUCH
            <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        </div>
    </div>

    <div class="contact-container">
        <div class="contact-info">
            <div class="c-item">
                <div class="c-icon"><svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></div>
                <div class="c-text">
                    <h4>Email</h4>
                    <p>dhrupodi@kuet.ac.bd</p>
                </div>
            </div>
            <div class="c-item">
                <div class="c-icon"><svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></div>
                <div class="c-text">
                    <h4>Phone</h4>
                    <p>+880 1234-567890</p>
                </div>
            </div>
            <div class="c-item">
                <div class="c-icon"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
                <div class="c-text">
                    <h4>Location</h4>
                    <p>KUET, Khulna<br>Bangladesh</p>
                </div>
            </div>
        </div>

        <div class="contact-form-box">
            <form action="/Dhrupodi/contact.php" method="POST">
                <div class="form-row">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                </div>
                <textarea placeholder="Your Message" required></textarea>
                <button type="submit" class="btn-submit-full">
                    Send Message 
                    <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

<?php require_once 'php/footer.php'; ?>                <div class="c-icon"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
                <div class="c-text">
                    <h4>Location</h4>
                    <p>KUET, Khulna<br>Bangladesh</p>
                </div>
            </div>
        </div>

        <div class="contact-form-box reveal-section">
            <form action="/Dhrupodi/contact.php" method="POST">
                <div class="form-row">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                </div>
                <textarea placeholder="Your Message" required></textarea>
                <button type="submit" class="btn-submit-full">
                    Send Message 
                    <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

<?php require_once 'php/footer.php'; ?>
