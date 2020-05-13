<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fad fa-bars"></i>
            </button>

            <span class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 text-primary" onclick="openFullscreen();">
                <i class="fad fa-expand"></i>
            </span>
            <ul class="navbar-nav mr-2 ml-auto">
                <span><?= $role['nama']; ?></span>
            </ul>

        </nav>
        <!-- End of Topbar -->