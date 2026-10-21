<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMAN 8 Bandung - Sistem Disiplin & Pelanggaran Siswa</title>
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6.5.2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <!-- DataTables 2.0 (Bootstrap 5) -->
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Custom Modern Theme CSS -->
    <link href="<?= base_url('css/modern-app.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    
    <div class="app-wrapper">
        <!-- Sidebar -->
        <aside class="app-sidebar" id="appSidebar">
            <div class="sidebar-brand">
                <div class="brand-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <h5>SMAN 8 Bandung</h5>
                    <small>Sistem Kedisiplinan Siswa</small>
                </div>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-header">Utama</div>
                <a href="<?= site_url('main/index') ?>" class="nav-link <?= (current_url() == site_url('main/index') || current_url() == site_url('main')) ? 'active' : '' ?>">
                    <i class="nav-icon fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>

                <?php 
                $role = session()->get('role');
                if ($role === 'Admin' || $role === 'Bagian Kedisiplinan'): 
                ?>
                    <div class="nav-header mt-3">Data Master</div>
                    <a href="<?= site_url('main/kelas') ?>" class="nav-link <?= strpos(current_url(), 'kelas') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-school"></i>
                        <span>Data Kelas</span>
                    </a>
                    <a href="<?= site_url('main/siswa') ?>" class="nav-link <?= (strpos(current_url(), 'siswa') !== false && strpos(current_url(), 'PelanggaranSiswa') === false && strpos(current_url(), 'data_pelanggaran_siswa') === false) ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <span>Data Siswa</span>
                    </a>
                    <a href="<?= site_url('main/data_wali_murid') ?>" class="nav-link <?= strpos(current_url(), 'data_wali_murid') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-user-group"></i>
                        <span>Wali Murid</span>
                    </a>
                    <?php if ($role === 'Admin'): ?>
                    <a href="<?= site_url('main/bagian_kedisiplinan') ?>" class="nav-link <?= strpos(current_url(), 'bagian_kedisiplinan') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-user-shield"></i>
                        <span>Staf Kedisiplinan</span>
                    </a>
                    <?php endif; ?>
                    <a href="<?= site_url('main/data_pelanggaran') ?>" class="nav-link <?= (strpos(current_url(), 'data_pelanggaran') !== false && strpos(current_url(), 'data_pelanggaran_siswa') === false) ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-triangle-exclamation"></i>
                        <span>Kategori Pelanggaran</span>
                    </a>

                    <div class="nav-header mt-3">Kedisiplinan & Sanksi</div>
                    <a href="<?= site_url('main/PelanggaranSiswa') ?>" class="nav-link <?= strpos(current_url(), 'PelanggaranSiswa') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-pen-to-square"></i>
                        <span>Catat Pelanggaran</span>
                    </a>
                    <a href="<?= site_url('main/lihat_pelanggaran') ?>" class="nav-link <?= strpos(current_url(), 'lihat_pelanggaran') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                        <span>Riwayat Pelanggaran</span>
                    </a>
                    <a href="<?= site_url('main/surat_penggilan_orang_tua') ?>" class="nav-link <?= (strpos(current_url(), 'surat_penggilan_orang_tua') !== false || strpos(current_url(), 'surat_panggilan_orang_tua') !== false || strpos(current_url(), 'data_wali_muridP') !== false || strpos(current_url(), 'surat_panggilan') !== false) ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-envelope-open-text"></i>
                        <span>Surat Panggilan (≥10 Poin)</span>
                    </a>
                    <a href="<?= site_url('main/input_periode') ?>" class="nav-link <?= strpos(current_url(), 'input_periode') !== false || strpos(current_url(), 'ViewLaporan') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-file-invoice"></i>
                        <span>Laporan Pelanggaran</span>
                    </a>
                <?php endif; ?>

                <?php if ($role === 'Siswa'): ?>
                    <div class="nav-header mt-3">Pelanggaran Saya</div>
                    <a href="<?= site_url('main/data_pelanggaran_siswa') ?>" class="nav-link <?= strpos(current_url(), 'data_pelanggaran_siswa') !== false ? 'active' : '' ?>">
                        <i class="nav-icon fa-solid fa-clipboard-list"></i>
                        <span>Riwayat Poin Saya</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Sidebar User Profile Info -->
            <div class="sidebar-user">
                <?php 
                $foto = session()->get('foto');
                $avatarUrl = !empty($foto) && file_exists(FCPATH . 'img/' . $foto) ? base_url('img/' . $foto) : base_url('img/user.jpg');
                ?>
                <img src="<?= $avatarUrl ?>" alt="Avatar" class="sidebar-user-avatar" onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode(session()->get('nama') ?? 'User') ?>&background=6366f1&color=fff'">
                <div class="sidebar-user-info">
                    <div class="user-name"><?= esc(session()->get('nama')) ?></div>
                    <div class="user-role"><i class="fa-solid fa-circle text-success me-1" style="font-size: 6px;"></i><?= esc(session()->get('role')) ?></div>
                </div>
                <a href="<?= site_url('login/logout') ?>" class="btn btn-sm btn-outline-light border-0 p-1 text-danger" title="Logout">
                    <i class="fa-solid fa-power-off"></i>
                </a>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="app-main">
            <!-- Top Navbar -->
            <header class="app-navbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="navbar-toggle-btn d-lg-none" id="sidebarToggle" type="button" aria-label="Toggle Sidebar">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="d-none d-md-flex align-items-center text-muted small">
                        <i class="fa-regular fa-calendar-days me-2 text-primary"></i>
                        <span id="currentDateDisplay"><?= date('l, d F Y') ?></span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <button class="btn btn-light rounded-pill px-3 py-2 d-flex align-items-center gap-2 border shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $avatarUrl ?>" alt="Avatar" class="rounded-circle" width="28" height="28" style="object-fit:cover;" onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode(session()->get('nama') ?? 'User') ?>&background=6366f1&color=fff'">
                            <span class="d-none d-sm-inline fw-semibold small"><?= esc(session()->get('nama')) ?></span>
                            <i class="fa-solid fa-chevron-down small text-muted"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2" style="min-width: 200px;">
                            <li class="px-3 py-2 border-bottom">
                                <div class="fw-bold small"><?= esc(session()->get('nama')) ?></div>
                                <div class="text-muted" style="font-size: 11px;"><?= esc(session()->get('role')) ?> (<?= esc(session()->get('username')) ?>)</div>
                            </li>
                            <?php if ($role === 'Admin' || $role === 'Bagian Kedisiplinan'): ?>
                                <li>
                                    <a class="dropdown-item py-2 small" href="<?= site_url('main/setting_admin/' . session()->get('username')) ?>">
                                        <i class="fa-regular fa-id-card me-2 text-primary"></i> Profil Saya
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="dropdown-item py-2 small" href="<?= site_url('main/setting_siswa/' . session()->get('username')) ?>">
                                        <i class="fa-regular fa-id-card me-2 text-primary"></i> Profil Saya
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <a class="dropdown-item py-2 small text-danger" href="<?= site_url('login/logout') ?>">
                                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="app-content">
                <!-- Flash Notification Messages -->
                <?php 
                $pesan = session()->get('pesan');
                $parameter = session()->get('parameter');
                if (!empty($pesan)): 
                ?>
                    <div class="alert <?= $parameter == '1' ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show shadow-sm border-0 rounded-3 d-flex align-items-center mb-4" role="alert">
                        <i class="<?= $parameter == '1' ? 'fa-solid fa-circle-check text-success' : 'fa-solid fa-circle-exclamation text-danger' ?> fs-4 me-3"></i>
                        <div>
                            <strong><?= $parameter == '1' ? 'Berhasil!' : 'Perhatian!' ?></strong> <?= esc($pesan) ?>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                    // Clear message after display
                    session()->remove('pesan');
                    session()->remove('parameter');
                    ?>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 d-flex align-items-center mb-4" role="alert">
                        <i class="fa-solid fa-circle-exclamation text-danger fs-4 me-3"></i>
                        <div>
                            <?= esc(session()->getFlashdata('error')) ?>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 d-flex align-items-center mb-4" role="alert">
                        <i class="fa-solid fa-circle-check text-success fs-4 me-3"></i>
                        <div>
                            <?= esc(session()->getFlashdata('success')) ?>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Dynamic View Rendering -->
                <?php if (isset($view) && !empty($view)): ?>
                    <?= view($view, get_defined_vars()) ?>
                <?php endif; ?>
            </main>

            <!-- Modern Footer -->
            <footer class="py-3 px-4 bg-white border-top text-center text-muted small mt-auto">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <div>
                        &copy; <?= date('Y') ?> <strong>SMAN 8 Bandung</strong> &bull; Sistem Disiplin & Sanksi Siswa
                    </div>
                    <div class="text-secondary">
                        <span class="badge bg-light text-dark border">CI 4.5.8</span> &bull; <span class="badge bg-light text-dark border">PHP 8.1</span> &bull; <span class="badge bg-light text-dark border">Bootstrap 5.3</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts: jQuery, Bootstrap 5 Bundle, DataTables 2, Chart.js -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <script>
        // Responsive Sidebar Toggle
        const sidebar = document.getElementById('appSidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const backdrop = document.getElementById('sidebarBackdrop');

        if (toggleBtn && sidebar && backdrop) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
            });

            backdrop.addEventListener('click', () => {
                sidebar.classList.remove('show');
                backdrop.classList.remove('show');
            });
        }

        // Initialize DataTables automatically on any matching table
        $(document).ready(function() {
            $('table.datatable, #dataTables-example, #dataTables-example1').each(function() {
                if (!$.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable({
                        responsive: true,
                        language: {
                            search: "Cari data:",
                            searchPlaceholder: "Ketik kata kunci...",
                            lengthMenu: "Tampilkan _MENU_ data",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            infoEmpty: "Menampilkan 0 data",
                            zeroRecords: "Tidak ada data yang cocok",
                            paginate: {
                                first: "Awal",
                                last: "Akhir",
                                next: "Lanjut",
                                previous: "Sebelum"
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
