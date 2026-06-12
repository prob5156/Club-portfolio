<?php
// member/includes/topbar.php
// execute query
$stmt = $pdo->prepare("SELECT name FROM members WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$memberName = $stmt->fetchColumn() ?: 'Member';
?>
<header class="topbar">
    <button class="menu-toggle" id="menu-toggle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </button>
    <div class="topbar-title">
        <h2>Member Portal</h2>
    </div>
    <div class="topbar-user">
        <span><?= htmlspecialchars($memberName) ?></span>
    </div>
</header>
