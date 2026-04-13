<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar" id="sidebar">

    <div class="sidebar-logo d-flex justify-content-center">
        <img src="/SRGS/assets/img/srgs-logo.png" alt="SRGS Logo" class="sidebar-logo-img rounded">
    </div>

    <ul class="sidebar-menu">

        <li class="<?= $current_page=='dashboard.php' ? 'active' : '' ?>">
            <a href="dashboard.php">
                <i data-feather="home"></i>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>

        <li class="<?= $current_page=='service.php' ? 'active' : '' ?>">
            <a href="service.php">
                <i data-feather="grid"></i>
                <span class="menu-text">Services</span>
            </a>
        </li>

        <li class="<?= $current_page=='projects.php' ? 'active' : '' ?>">
            <a href="projects.php">
                <i data-feather="folder"></i>
                <span class="menu-text">Projects</span>
            </a>
        </li>

        <li class="<?= $current_page=='contacts.php' ? 'active' : '' ?>">
            <a href="contacts.php">
                <i data-feather="mail"></i>
                <span class="menu-text">Contacts</span>
            </a>
        </li>

        <li>
            <a href="logout.php" class="logout">
                <i data-feather="log-out"></i>
                <span class="menu-text">Logout</span>
            </a>
        </li>

    </ul>

</div>
<div id="overlay" onclick="toggleSidebar()"></div>