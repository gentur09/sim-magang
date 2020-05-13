<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('backend/admin/dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <!-- <i class="fad fa-chart-network"></i> -->
            <img src="<?= base_url('assets/') ?>image/Icon/degree.png" alt="Brand">
        </div>
        <div class="sidebar-brand-text mx-3">SIM Magang</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/admin/dashboard'); ?>">
            <i class="fad fa-fw fa-home"></i>
            <span id="sidebar-text">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Instrumen
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/admin/pembimbing'); ?>">
            <i class="fad fa-fw fa-chalkboard-teacher"></i>
            <span id="sidebar-text">Pembimbing</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/admin/mahasiswa'); ?>">
            <i class="fad fa-fw fa-user-graduate"></i>
            <span id="sidebar-text">Mahasiswa</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/admin/kinerja') ?>">
            <i class="fad fa-fw fa-clipboard-list-check"></i>
            <span id="sidebar-text">Kinerja Mahasiswa</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Referensi
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/admin/referensi/universitas'); ?>">
            <i class="fad fa-fw fa-university"></i>
            <span id="sidebar-text">Universitas</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/admin/referensi/role'); ?>">
            <i class="fad fa-fw fa-user-hard-hat"></i>
            <span id="sidebar-text">Role</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('backend/admin/referensi/jabatan'); ?>">
            <i class="fad fa-fw fa-sitemap"></i>
            <span id="sidebar-text">Jabatan</span></a>
    </li>

    <hr class="sidebar-divider mb-0">

    <li class="nav-item">
        <a class="nav-link" href="" data-toggle="modal" data-target="#logout_modal">
            <i class="fad fa-fw fa-sign-out"></i>
            <span id="sidebar-text">Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->