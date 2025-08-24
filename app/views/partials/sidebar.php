<?php
// sidebar.php
$current_page = $_GET['page'] ?? 'dashboard';
?>
<aside class="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a href="index.php?page=dashboard" class="<?= ($current_page == 'dashboard') ? 'active' : ''; ?>">
                🏠 Dashboard
            </a>
        </li>

        <li>
            <a href="index.php?page=score" class="<?= ($current_page == 'score') ? 'active' : ''; ?>">
                📊 Score
            </a>
        </li>

        <li>
            <a href="index.php?page=game" class="<?= ($current_page == 'game') ? 'active' : ''; ?>">
                🎮 Games
            </a>
        </li>

        <li>
            <a href="index.php?page=assignment" class="<?= ($current_page == 'assignment') ? 'active' : ''; ?>">
                👥 Assign Participant
            </a>
        </li>

        <li>
            <a href="index.php?page=participant" class="<?= ($current_page == 'participant') ? 'active' : ''; ?>">
                📅 Participant
            </a>
        </li>

        <li>
            <a href="logout.php" class="<?= ($current_page == 'logout') ? 'active' : ''; ?>">
                🚪 Logout
            </a>
        </li>
    </ul>
</aside>
