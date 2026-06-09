<?php
$pageTitle = "Members - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Meet the talented dancers and directors of Dhrupodi Dancers' Association of KUET.";
$pageStylesheets = ['/Dhrupodi/css/pages/members.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';

// Helper function to render a member card with data attributes for the drawer
function renderMemberCard($imageFile, $name, $role, $dept="Department of CSE", $batch="Batch 2k21", $bio="Passionate dancer and coordinator dedicated to preserving and promoting cultural heritage through various dance forms.") {
    echo '
    <div class="member-card" 
         data-name="' . htmlspecialchars($name) . '" 
         data-role="' . htmlspecialchars($role) . '"
         data-dept="' . htmlspecialchars($dept) . '"
         data-batch="' . htmlspecialchars($batch) . '"
         data-bio="' . htmlspecialchars($bio) . '"
         data-image="/Dhrupodi/images/' . htmlspecialchars($imageFile) . '">
        
        <div class="member-image">
            <img src="/Dhrupodi/images/' . htmlspecialchars($imageFile) . '" alt="' . htmlspecialchars($name) . '">
        </div>
        <div class="member-info">
            <h3>' . htmlspecialchars($name) . '</h3>
            <span class="member-role">' . htmlspecialchars($role) . '</span>
            <button class="view-profile-btn">View Profile &rarr;</button>
        </div>
    </div>';
}
?>

	<!-- Members Section -->
	<section id="members" class="members-section">
		<div class="content">
			<h2 class="page-title">Our Committee Members</h2>
			<p class="page-intro">Meet the dedicated individuals who lead and manage Dhrupodi.</p>
			
            <!-- President Section -->
            <div class="role-section single-member">
                <h3 class="role-title">President</h3>
                <div class="members-grid">
                    <?php renderMemberCard("President.jpg", "Member Name", "President"); ?>
                </div>
            </div>

            <!-- Vice Presidents Section -->
            <div class="role-section">
                <h3 class="role-title">Vice Presidents</h3>
                <div class="members-grid">
                    <?php 
                    renderMemberCard("Vice-President.jpg", "Member Name", "Vice President");
                    for($i = 2; $i <= 8; $i++) {
                        renderMemberCard("Vice-President $i.jpg", "Member Name", "Vice President");
                    }
                    ?>
                </div>
            </div>

            <!-- General Secretary Section -->
            <div class="role-section single-member">
                <h3 class="role-title">General Secretary</h3>
                <div class="members-grid">
                    <?php renderMemberCard("General Secretary.jpg", "Member Name", "General Secretary"); ?>
                </div>
            </div>

            <!-- Assistant General Secretaries Section -->
            <div class="role-section">
                <h3 class="role-title">Assistant General Secretaries</h3>
                <div class="members-grid">
                    <?php 
                    renderMemberCard("Assistant Genaral Secratary.jpg", "Member Name", "Assistant General Secretary");
                    renderMemberCard("Assistant Genaral Secratary 2.jpg", "Member Name", "Assistant General Secretary");
                    renderMemberCard("Assistant General Secratary 3.jpg", "Member Name", "Assistant General Secretary");
                    for($i = 4; $i <= 11; $i++) {
                        renderMemberCard("Assistant Genaral Secratary $i.jpg", "Member Name", "Assistant General Secretary");
                    }
                    ?>
                </div>
            </div>

            <!-- Organising Secretaries Section -->
            <div class="role-section">
                <h3 class="role-title">Organising Secretaries</h3>
                <div class="members-grid">
                    <?php 
                    renderMemberCard("Organising Secretary.jpg", "Member Name", "Organising Secretary");
                    renderMemberCard("Organising Secretary 2.jpg", "Member Name", "Organising Secretary");
                    renderMemberCard("Organising Secretary 3.jpg", "Member Name", "Organising Secretary");
                    ?>
                </div>
            </div>

		</div>
	</section>

    <!-- Side Drawer & Overlay -->
    <div class="drawer-overlay" id="drawerOverlay"></div>
    <aside class="member-drawer" id="memberDrawer">
        <div class="drawer-header">
            <button class="drawer-close" id="drawerClose">&times;</button>
        </div>
        <div class="drawer-content">
            <div class="drawer-image">
                <img id="drawerImg" src="" alt="Profile Image">
            </div>
            <h3 class="drawer-name" id="drawerName">Name</h3>
            <div class="drawer-role" id="drawerRole">Role</div>
            
            <div class="drawer-meta">
                <div class="drawer-meta-item">
                    <span class="drawer-meta-label">Department</span>
                    <span class="drawer-meta-value" id="drawerDept">CSE</span>
                </div>
                <div class="drawer-meta-item">
                    <span class="drawer-meta-label">Batch</span>
                    <span class="drawer-meta-value" id="drawerBatch">2k21</span>
                </div>
            </div>

            <p class="drawer-bio" id="drawerBio">Bio goes here...</p>

            <div class="drawer-social">
                <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg></a>
                <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m4.4 4.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m0 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m5.3-3.1a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z"/></svg></a>
                <a href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg></a>
                <a href="#" aria-label="Email"><svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></a>
                <a href="#" aria-label="Phone"><svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></a>
            </div>
        </div>
    </aside>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.member-card');
        const drawer = document.getElementById('memberDrawer');
        const overlay = document.getElementById('drawerOverlay');
        const closeBtn = document.getElementById('drawerClose');

        // Elements inside drawer
        const dImg = document.getElementById('drawerImg');
        const dName = document.getElementById('drawerName');
        const dRole = document.getElementById('drawerRole');
        const dDept = document.getElementById('drawerDept');
        const dBatch = document.getElementById('drawerBatch');
        const dBio = document.getElementById('drawerBio');

        function openDrawer(card) {
            // Populate data
            dImg.src = card.dataset.image;
            dName.textContent = card.dataset.name;
            dRole.textContent = card.dataset.role;
            dDept.textContent = card.dataset.dept;
            dBatch.textContent = card.dataset.batch;
            dBio.textContent = card.dataset.bio;

            // Open drawer
            drawer.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeDrawer() {
            drawer.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        cards.forEach(card => {
            card.addEventListener('click', () => openDrawer(card));
        });

        closeBtn.addEventListener('click', closeDrawer);
        overlay.addEventListener('click', closeDrawer);
    });
    </script>

<?php require_once 'php/footer.php'; ?>