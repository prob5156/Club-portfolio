<?php
$pageTitle = "Members - Dhrupodi Dancers' Association - KUET";
$pageDescription = "Meet the passionate people behind Dhrupodi Dancers' Association of KUET.";
$pageStylesheets = ['/Dhrupodi/css/pages/members.css'];
require_once 'php/header.php';
require_once 'php/navbar.php';

// Dynamic Categorization Logic
$imageDir = __DIR__ . '/images/';
$allFiles = array_diff(scandir($imageDir), array('.', '..'));

$execKeywords = ['president', 'secretary', 'secratary', 'treasurer', 'executive', 'committee'];
$coreKeywords = ['member', 'membe5'];

$execs = [];
$cores = [];

foreach($allFiles as $file) {
    if(!preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) continue;

    $filenameLower = strtolower($file);
    $basename = pathinfo($file, PATHINFO_FILENAME);
    
    // Clean up basename to get designation (remove numbers and extra spaces)
    $designation = preg_replace('/[0-9]+/', '', $basename);
    $designation = trim(str_replace(['-', '_'], ' ', $designation));
    
    // Fix typos if any
    $designation = str_ireplace('Genaral Secratary', 'General Secretary', $designation);
    
    $isExec = false;
    foreach($execKeywords as $keyword) {
        if(strpos($filenameLower, $keyword) !== false) {
            $isExec = true;
            break;
        }
    }
    
    $isCore = false;
    foreach($coreKeywords as $keyword) {
        if(strpos($filenameLower, $keyword) !== false) {
            $isCore = true;
            break;
        }
    }
    
    // Rules: If it's Exec, it goes to Exec. If it's Core, it goes to Core. 
    // Do NOT mix them. Do NOT duplicate.
    if($isExec) {
        $execs[] = [
            'file' => $file,
            'role' => ucwords($designation),
            'name' => 'Member Name' 
        ];
    } else if($isCore) {
        $cores[] = [
            'file' => $file,
            'role' => 'Member',
            'name' => 'Member Name'
        ];
    }
}

// Sort Executive Committee by hierarchy
$hierarchy = [
    'president' => 1,
    'vice president' => 2,
    'general secretary' => 3,
    'joint secretary' => 4,
    'assistant general secretary' => 5,
    'organising secretary' => 6,
    'organizing secretary' => 6,
    'treasurer' => 7,
    'cultural secretary' => 8,
    'office secretary' => 9,
    'executive' => 10,
    'committee' => 11
];

usort($execs, function($a, $b) use ($hierarchy) {
    $roleA = strtolower($a['role']);
    $roleB = strtolower($b['role']);
    
    $rankA = 99;
    $rankB = 99;
    
    foreach($hierarchy as $key => $rank) {
        if(strpos($roleA, $key) !== false && $rankA === 99) $rankA = $rank;
        if(strpos($roleB, $key) !== false && $rankB === 99) $rankB = $rank;
    }
    
    if($rankA === $rankB) {
        // If same rank (e.g. two Vice Presidents), sort alphabetically by filename
        return strcmp($a['file'], $b['file']);
    }
    
    return $rankA - $rankB;
});

function renderMCard($imageFile, $name, $role, $dept="Department of CSE", $batch="Batch 2k21", $bio="Passionate dancer and coordinator dedicated to preserving and promoting cultural heritage.") {
    echo '
    <div class="m-card member-card" 
         data-name="' . htmlspecialchars($name) . '" 
         data-role="' . htmlspecialchars($role) . '"
         data-dept="' . htmlspecialchars($dept) . '"
         data-batch="' . htmlspecialchars($batch) . '"
         data-bio="' . htmlspecialchars($bio) . '"
         data-image="/Dhrupodi/images/' . htmlspecialchars($imageFile) . '">
        
        <div class="m-img-wrapper">
            <img src="/Dhrupodi/images/' . htmlspecialchars($imageFile) . '" alt="' . htmlspecialchars($name) . '" onerror="this.src=\'/Dhrupodi/images/Event 1.jpg\'">
        </div>
        
        <div class="m-info">
            <h3 class="m-name">' . htmlspecialchars($name) . '</h3>
            <span class="m-role">' . htmlspecialchars($role) . '</span>
            
            <div class="m-social">
                <a href="#" aria-label="Facebook" onclick="event.stopPropagation();">
                    <svg viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                </a>
                <a href="#" aria-label="Instagram" onclick="event.stopPropagation();">
                    <svg viewBox="0 0 24 24"><path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m4.4 4.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m0 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m5.3-3.1a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z"/></svg>
                </a>
                <a href="#" aria-label="Email" onclick="event.stopPropagation();">
                    <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </a>
            </div>
            
            <button class="m-view-profile">View Profile &rarr;</button>
        </div>
    </div>';
}
?>

<style>
body {
    background: url('/Dhrupodi/images/bg gallery.png') no-repeat top center fixed !important;
    background-size: cover !important;
}
.members-page {
    position: relative;
    z-index: 1;
}
</style>

<div class="members-page">
    <div class="members-header">
        <div class="m-section-kicker">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            MEMBERS
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        </div>
        <h1 class="m-page-title">Our Members</h1>
        <p class="m-page-intro">Meet the passionate people behind Dhrupodi Dancers' Association of KUET.</p>
        <div class="m-header-divider"></div>
    </div>

    <!-- Section 1: Executive Committee -->
    <?php if(!empty($execs)): ?>
    <div class="role-section">
        <div class="role-section-header">
            <div class="role-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div class="role-title-group">
                <h2>Executive Committee</h2>
                <p>Leading the team with vision, dedication and responsibility.</p>
            </div>
        </div>

        <div class="members-scroll-container exec-scroll">
            <div class="members-grid">
                <?php 
                foreach($execs as $exec) {
                    renderMCard($exec['file'], $exec['name'], $exec['role']);
                }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Section 2: Core Members -->
    <?php if(!empty($cores)): ?>
    <div class="role-section">
        <div class="role-section-header">
            <div class="role-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div class="role-title-group">
                <h2>Core Members</h2>
                <p>The backbone of our association and creative force behind every performance.</p>
            </div>
        </div>

        <div class="members-scroll-container core-scroll">
            <div class="members-grid">
                <?php 
                foreach($cores as $core) {
                    renderMCard($core['file'], $core['name'], $core['role']);
                }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

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
    const profileBtns = document.querySelectorAll('.member-card .m-view-profile');
    const drawer = document.getElementById('memberDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const closeBtn = document.getElementById('drawerClose');

    const dImg = document.getElementById('drawerImg');
    const dName = document.getElementById('drawerName');
    const dRole = document.getElementById('drawerRole');
    const dDept = document.getElementById('drawerDept');
    const dBatch = document.getElementById('drawerBatch');
    const dBio = document.getElementById('drawerBio');

    function openDrawer(card) {
        dImg.src = card.dataset.image;
        dName.textContent = card.dataset.name;
        dRole.textContent = card.dataset.role;
        dDept.textContent = card.dataset.dept;
        dBatch.textContent = card.dataset.batch;
        dBio.textContent = card.dataset.bio;

        drawer.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden'; 
    }

    function closeDrawer() {
        drawer.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    profileBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const card = e.target.closest('.member-card');
            openDrawer(card);
        });
    });

    closeBtn.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);

    // Smooth Nested Scrolling for Scroll Containers
    const scrollContainers = document.querySelectorAll('.members-scroll-container');
    scrollContainers.forEach(container => {
        container.addEventListener('wheel', function(e) {
            const isAtTop = this.scrollTop === 0;
            // +1 to account for sub-pixel rendering rounding
            const isAtBottom = this.scrollHeight - this.scrollTop <= this.clientHeight + 1;
            
            // If scrolling UP and at the top, or scrolling DOWN and at the bottom
            if ((e.deltaY < 0 && isAtTop) || (e.deltaY > 0 && isAtBottom)) {
                e.preventDefault(); // Stop the container from "trying" to scroll
                window.scrollBy({ top: e.deltaY, behavior: 'auto' }); // Scroll the page
            }
        }, { passive: false });
    });
});
</script>

<?php require_once 'php/footer.php'; ?>