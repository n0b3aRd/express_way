<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location:index.php');
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Express <sup>Way</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="admin.dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
<!--    <div class="sidebar-heading">-->
<!--        Interface-->
<!--    </div>-->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Jobs</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Job Option:</h6>
                <a class="collapse-item" href="admin.create.job.php">New Job</a>
                <a class="collapse-item" href="admin.pending.job.list.php">Pending Jobs</a>
                <a class="collapse-item" href="admin.complete.job.list.php">Complete Jobs</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse"
           aria-expanded="true" aria-controls="collapse">
            <i class="fas fa-fw fa-cog"></i>
            <span>Riders</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Rider Option:</h6>
                <a class="collapse-item" href="admin.create.rider.php">New Rider</a>
                <a class="collapse-item" href="admin.rider.list.php">Riders list</a>
            </div>
        </div>
    </li>


</ul>
<!-- End of Sidebar -->