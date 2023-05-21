<?php if ($user['role'] == 'admin') : ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center" href="index.php">
            <div class="sidebar-brand-icon">
                <img src="../img/himit.png" width="50" alt="">
            </div>
            <div class="sidebar-brand-text ml-3">ETHOS</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->

        <div class="sidebar-heading">
            Data
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="./users.php">
                <i class="fas fa-solid fa-user"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./mahasiswa.php">
                <i class="fas fa-graduation-cap fa-cog"></i>
                <span>Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./dosen.php">
                <i class="fas fa-solid fa-user-tie"></i>
                <span>Dosen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./matakuliah.php">
                <i class="fas fa-solid fa-book fa-2x"></i>
                <span>Matakuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./nilai.php">
                <i class="fas fa-solid fa-book-open"></i>
                <span>Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./kelas.php">
                <i class="fas fa-solid fa-comments"></i>
                <span>kelas</span>
            </a>
        </li>

        <div class="sidebar-heading">
            Fitur Master
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="./add_mahasiswa.php">
                <i class="fas fa-plus fa-cog"></i>
                <span>Tambah Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./add_dosen.php">
                <i class="fas fa-plus fa-cog"></i>
                <span>Tambah Dosen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./add_matakuliah.php">
                <i class="fas fa-plus fa-cog"></i>
                <span>Tambah Matakuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./add_kelas.php">
                <i class="fas fa-plus fa-cog"></i>
                <span>Tambah Kelas</span>
            </a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
<?php endif; ?>

<?php if ($user['role'] == 'mahasiswa') : ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center" href="index.php">
            <div class="sidebar-brand-icon">
                <img src="../img/himit.png" width="50" alt="">
            </div>
            <div class="sidebar-brand-text ml-3">ETHOS</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->

        <div class="sidebar-heading">
            Pembelajaran
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./matakuliah.php">
                <i class="fas fa-solid fa-book fa-2x"></i>
                <span>Matakuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./nilai.php">
                <i class="fas fa-solid fa-book-open"></i>
                <span>Nilai</span>
            </a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
<?php endif; ?>

<?php if ($user['role'] == 'dosen') : ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center" href="index.php">
            <div class="sidebar-brand-icon">
                <img src="../img/himit.png" width="50" alt="">
            </div>
            <div class="sidebar-brand-text ml-3">ETHOS</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->

        <div class="sidebar-heading">
            Data
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./matakuliah.php">
                <i class="fas fa-solid fa-book fa-2x"></i>
                <span>Matakuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./nilai.php">
                <i class="fas fa-solid fa-book-open"></i>
                <span>Nilai</span>
            </a>
        </li>

        <div class="sidebar-heading">
            Fitur Master
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="./add_matakuliah.php">
                <i class="fas fa-plus fa-cog"></i>
                <span>Tambah Matakuliah</span>
            </a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
<?php endif; ?>