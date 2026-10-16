<!-- KPI Summary Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-primary">
            <i class="fa-solid fa-user-graduate stat-icon"></i>
            <div class="stat-number"><?= esc($total_siswa ?? 0) ?></div>
            <div class="stat-label">Total Siswa</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-danger">
            <i class="fa-solid fa-triangle-exclamation stat-icon"></i>
            <div class="stat-number"><?= esc($total_pelanggaran ?? 0) ?></div>
            <div class="stat-label">Total Pelanggaran</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-success">
            <i class="fa-solid fa-user-shield stat-icon"></i>
            <div class="stat-number"><?= esc($total_guru ?? 0) ?></div>
            <div class="stat-label">Staf Kedisiplinan</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-warning">
            <i class="fa-solid fa-school stat-icon"></i>
            <div class="stat-number"><?= esc($total_kelas ?? 0) ?></div>
            <div class="stat-label">Total Kelas</div>
        </div>
    </div>
</div>

<!-- Nav Tabs for Charts -->
<div class="card-modern mb-4">
    <div class="card-modern-header p-0 bg-light border-bottom">
        <ul class="nav nav-tabs border-0 px-3 pt-2" id="chartTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-semibold small py-3" id="tab-bulan-tahun" data-bs-toggle="tab" data-bs-target="#panel-bulan-tahun" type="button" role="tab">
                    <i class="fa-regular fa-calendar-check me-2 text-primary"></i> Grafik Bulan & Tahun
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold small py-3" id="tab-kelas" data-bs-toggle="tab" data-bs-target="#panel-kelas" type="button" role="tab">
                    <i class="fa-solid fa-graduation-cap me-2 text-success"></i> Grafik Per Kelas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-semibold small py-3" id="tab-gabungan" data-bs-toggle="tab" data-bs-target="#panel-gabungan" type="button" role="tab">
                    <i class="fa-solid fa-layer-group me-2 text-warning"></i> Grafik Kelas, Bulan & Tahun
                </button>
            </li>
        </ul>
    </div>

    <div class="card-modern-body">
        <div class="tab-content" id="chartTabsContent">
            
            <!-- Panel 1: Bulan & Tahun -->
            <div class="tab-pane fade show active" id="panel-bulan-tahun" role="tabpanel">
                <div class="row g-3 align-items-end mb-4 bg-light p-3 rounded-3 border">
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="bulan">Pilih Bulan</label>
                        <select id="bulan" class="form-select">
                            <option value="">-- Pilih Bulan --</option>
                            <?php 
                            $bulanArr = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                            $currM = (int)date('m');
                            foreach ($bulanArr as $num => $namaBulan): ?>
                                <option value="<?= $num ?>" <?= $num == $currM ? 'selected' : '' ?>><?= $namaBulan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="tahun">Pilih Tahun</label>
                        <select id="tahun" class="form-select">
                            <option value="">-- Pilih Tahun --</option>
                            <?php 
                            $currY = (int)date('Y');
                            if (!empty($tahun)):
                                foreach ($tahun as $vaData): ?>
                                    <option value="<?= $vaData['tahun_pelanggaran'] ?>" <?= $vaData['tahun_pelanggaran'] == $currY ? 'selected' : '' ?>>
                                        <?= $vaData['tahun_pelanggaran'] ?>
                                    </option>
                                <?php endforeach;
                            endif; ?>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="<?= $currY ?>"><?= $currY ?></option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <button type="button" class="btn btn-primary w-100" onclick="grafik1();">
                            <i class="fa-solid fa-filter me-2"></i> Tampilkan Grafik
                        </button>
                    </div>
                </div>

                <div class="row" id="grafik-1">
                    <div class="col-12">
                        <div class="p-3 bg-white rounded-3 shadow-sm border">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-primary">
                                    <i class="fa-solid fa-chart-column me-2"></i> Statistik Pelanggaran Berdasarkan Kategori
                                </h6>
                                <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($grafik_bulan_tahun ?? []) ?> Kategori</span>
                            </div>
                            <div style="position: relative; height: 350px;">
                                <canvas id="canvasChartHome"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 2: Per Kelas -->
            <div class="tab-pane fade" id="panel-kelas" role="tabpanel">
                <div class="row g-3 align-items-end mb-4 bg-light p-3 rounded-3 border">
                    <div class="col-12 col-md-8">
                        <label class="form-label" for="kelas">Pilih Kelas</label>
                        <select id="kelas" class="form-select">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($kelas as $vaKelas): ?>
                                <option value="<?= $vaKelas['id_kelas'] ?>">
                                    Kelas <?= esc($vaKelas['kelas']) ?> <?= esc($vaKelas['jurusan']) ?> <?= esc($vaKelas['no_kelas']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <button type="button" class="btn btn-success w-100 text-white" onclick="grafik2();">
                            <i class="fa-solid fa-filter me-2"></i> Tampilkan Grafik
                        </button>
                    </div>
                </div>

                <div class="row" id="grafik-2">
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-chart-simple fs-1 d-block mb-3 opacity-25"></i>
                        Silakan pilih kelas dan klik tombol "Tampilkan Grafik"
                    </div>
                </div>
            </div>

            <!-- Panel 3: Kelas + Bulan + Tahun -->
            <div class="tab-pane fade" id="panel-gabungan" role="tabpanel">
                <div class="row g-3 align-items-end mb-4 bg-light p-3 rounded-3 border">
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="kelas2">Pilih Kelas</label>
                        <select id="kelas2" class="form-select">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($kelas as $vaKelas): ?>
                                <option value="<?= $vaKelas['id_kelas'] ?>">
                                    Kelas <?= esc($vaKelas['kelas']) ?> <?= esc($vaKelas['jurusan']) ?> <?= esc($vaKelas['no_kelas']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="bulan2">Bulan</label>
                        <select id="bulan2" class="form-select">
                            <option value="">-- Pilih Bulan --</option>
                            <?php foreach ($bulanArr as $num => $namaBulan): ?>
                                <option value="<?= $num ?>"><?= $namaBulan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="tahun2">Tahun</label>
                        <select id="tahun2" class="form-select">
                            <option value="">-- Pilih Tahun --</option>
                            <?php 
                            if (!empty($tahun)):
                                foreach ($tahun as $vaData): ?>
                                    <option value="<?= $vaData['tahun_pelanggaran'] ?>"><?= $vaData['tahun_pelanggaran'] ?></option>
                                <?php endforeach;
                            endif; ?>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="<?= $currY ?>"><?= $currY ?></option>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="button" class="btn btn-warning w-100 text-dark fw-bold" onclick="grafik3();">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>
                    </div>
                </div>

                <div class="row" id="grafik-3">
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-chart-pie fs-1 d-block mb-3 opacity-25"></i>
                        Pilih Kelas, Bulan, dan Tahun untuk menampilkan data grafik gabungan.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Initial Chart on Load
document.addEventListener("DOMContentLoaded", function() {
    var initialLabels = [];
    var initialData = [];

    <?php if (!empty($grafik_bulan_tahun)): ?>
        <?php foreach ($grafik_bulan_tahun as $item): ?>
            initialLabels.push(<?= json_encode($item['nama_pelanggaran']) ?>);
            initialData.push(<?= (int)$item['JumlahPelanggaran'] ?>);
        <?php endforeach; ?>
    <?php endif; ?>

    var ctx = document.getElementById('canvasChartHome');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: initialLabels,
                datasets: [{
                    label: 'Jumlah Pelanggaran',
                    data: initialData,
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.85)',
                        'rgba(14, 165, 233, 0.85)',
                        'rgba(245, 158, 11, 0.85)',
                        'rgba(239, 68, 68, 0.85)',
                        'rgba(16, 185, 129, 0.85)',
                        'rgba(168, 85, 247, 0.85)'
                    ],
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 20
                        }
                    }
                }
            }
        });
    }
});

// AJAX grafik1
function grafik1() {
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();

    if (!bulan || !tahun) {
        alert('Silakan pilih Bulan dan Tahun terlebih dahulu.');
        return;
    }

    $.ajax({
        type: "POST",
        url: "<?= site_url('main/grafik_1') ?>",
        data: { bulan: bulan, tahun: tahun },
        beforeSend: function() {
            $('#grafik-1').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><div class="mt-2 text-muted small">Memuat grafik...</div></div>');
        },
        success: function(response) {
            $('#grafik-1').html(response);
        },
        error: function() {
            $('#grafik-1').html('<div class="alert alert-danger">Gagal memuat grafik. Silakan coba lagi.</div>');
        }
    });
}

// AJAX grafik2
function grafik2() {
    var kelas = $('#kelas').val();

    if (!kelas) {
        alert('Silakan pilih Kelas terlebih dahulu.');
        return;
    }

    $.ajax({
        type: "POST",
        url: "<?= site_url('main/grafik_2') ?>",
        data: { kelas: kelas, id_kelas: kelas },
        beforeSend: function() {
            $('#grafik-2').html('<div class="text-center py-5"><div class="spinner-border text-success" role="status"></div><div class="mt-2 text-muted small">Memuat grafik...</div></div>');
        },
        success: function(response) {
            $('#grafik-2').html(response);
        },
        error: function() {
            $('#grafik-2').html('<div class="alert alert-danger">Gagal memuat grafik. Silakan coba lagi.</div>');
        }
    });
}

// AJAX grafik3
function grafik3() {
    var kelas = $('#kelas2').val();
    var bulan = $('#bulan2').val();
    var tahun = $('#tahun2').val();

    if (!kelas || !bulan || !tahun) {
        alert('Silakan lengkapi pilihan Kelas, Bulan, dan Tahun.');
        return;
    }

    $.ajax({
        type: "POST",
        url: "<?= site_url('main/grafik_3') ?>",
        data: { kelas: kelas, bulan: bulan, tahun: tahun },
        beforeSend: function() {
            $('#grafik-3').html('<div class="text-center py-5"><div class="spinner-border text-warning" role="status"></div><div class="mt-2 text-muted small">Memuat grafik...</div></div>');
        },
        success: function(response) {
            $('#grafik-3').html(response);
        },
        error: function() {
            $('#grafik-3').html('<div class="alert alert-danger">Gagal memuat grafik. Silakan coba lagi.</div>');
        }
    });
}
</script>
