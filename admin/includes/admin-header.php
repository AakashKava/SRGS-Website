<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SRGS/includes/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SRGS/includes/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SRGS Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/SRGS/assets/css/style.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            background: #f5f7fa;
        }

        .admin-wrapper {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(
                184.15deg,
                rgba(28, 37, 57, 0) -187.51%,
                #1c2539 96.62%
            );
            color: #fff;
            transition: 0.3s;
            position: fixed;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-logo {
            padding: 20px;
            font-size: 22px;
            font-weight: 700;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin: 5px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }

        /* ACTIVE */
        .sidebar-menu li.active a {
            color: #fff;
            border-left: 3px solid #4f46e5;
            background: rgba(255,255,255,0.08);
        }

        /* ICON */
        .sidebar-menu i {
            width: 20px;
        }

        /* COLLAPSED TEXT HIDE */
        .sidebar.collapsed .menu-text {
            display: none;
        }

        .sidebar.collapsed .sidebar-logo {
            font-size: 16px;
        }

        /* CONTENT */
        .admin-content {
            margin-left: 260px;
            width: 100%;
            padding: 20px;
            transition: 0.3s;
        }

        body.sidebar-collapsed .sidebar {
            width: 80px;
        }

        body.sidebar-collapsed .sidebar .menu-text {
            display: none;
        }

        body.sidebar-collapsed .admin-content {
            margin-left: 80px;
        }

        /* TOPBAR */
        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* LOGOUT */
        .logout {
            margin: 15px 10px 0px 10px;
            background: rgba(255, 0, 0, 0.1);
            color: #ff6b6b !important;
            border-radius: 10px;
        }

        /* MOBILE */
       @media (max-width: 767px) {
            .sidebar {
                left: -260px;
                position: fixed;
                z-index: 999;
                top: 0;
            }

            .sidebar.active {   
                left: 0;
            }

            .admin-content {
                margin-left: 0 !important;
                width: 100%;
            }
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* MENU BUTTON */
        .menu-toggle {
            border: none;
            background: #1c2539;
            color: #fff;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        /* TITLE */
        .topbar h5 {
            font-weight: 600;
        }

        /* RIGHT SIDE */
        .admin-name {
            font-size: 14px;
            color: #555;
        }

        /* LOGOUT BUTTON */
        .logout-btn {
            background: rgba(255, 0, 0, 0.1);
            color: #ff4d4d;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: rgba(255, 0, 0, 0.2);
        }

        .sidebar-logo-img {
            max-width: 120px;
            transition: 0.3s;
        }

        body.sidebar-collapsed .sidebar-logo-img {
            max-width: 40px;
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            display: none;
            z-index: 998;
        }
    </style>
</head>

<body>

<div class="admin-wrapper">