<?php
if(!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header('Location:index.php');
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="rider.dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Express <sup>Way</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" id="dashboard_nav">
        <a class="nav-link" href="rider.dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item" id="jobs_nav">
        <a class="nav-link" href="rider.jobs.list.php?page=all">
            <i class="fas fa-clipboard-list"></i>
            <span>Jobs</span></a>
    </li>
    <li class="nav-item" id="my_jobs_nav">
        <a class="nav-link" href="rider.jobs.list.php?page=my">
            <i class="fas fa-biking"></i>
            <span>My Jobs</span></a>
    </li>
    <li class="nav-item" id="my_account_nav">
        <a class="nav-link" href="rider.account.php">
            <i class="fas fa-user"></i>
            <span>My Account</span></a>
    </li>


</ul>
<!-- End of Sidebar -->
