<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('backend/mahasiswa/profile'); ?>">
        <div class="sidebar-brand-icon">
            <!-- <i class="fad fa-chart-network"></i> -->
            <img src="<?= base_url('assets/') ?>image/Icon/degree.png" alt="Brand">
        </div>
        <div class="sidebar-brand-text mx-3">SIM Magang</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/mahasiswa/profile'); ?>">
            <i class="fad fa-fw fa-chalkboard-teacher"></i>
            <span id="sidebar-text">Profile</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/mahasiswa/kinerja') ?>">
            <i class="fad fa-fw fa-clipboard-list-check"></i>
            <span id="sidebar-text">Kinerja Mahasiswa</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <li class="nav-item">
        <a class="nav-link" href="" data-toggle="modal" data-target="#logout_modal">
            <i class="fad fa-fw fa-sign-out"></i>
            <span id="sidebar-text">Sign Out</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
