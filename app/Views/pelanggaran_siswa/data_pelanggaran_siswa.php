<?php 
$totalPoint = 0;
foreach ($siswa as $item) {
    $totalPoint += (int)($item['point'] ?? 0);
}
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-clipboard-user text-primary me-2"></i>Riwayat Pelanggaran & Poin Saya</h4>
            <p class="text-muted small mb-0">Pantau catatan kedisiplinan dan akumulasi poin sanksi Anda</p>
        </div>
    </div>

    <!-- Student Info & Score Card -->
    <div class="col-12 col-lg-4">
        <div class="card-modern text-center p-4">
            <div class="mb-3 position-relative d-inline-block">
                <?php if (!empty($foto) && file_exists(FCPATH . 'img/' . $foto)): ?>
                    <img src="<?= base_url('img/' . $foto) ?>" class="rounded-circle shadow" width="120" height="120" style="object-fit:cover;">
                <?php else: ?>
                    <div class="rounded-circle bg-light border mx-auto d-flex align-items-center justify-content-center text-primary fw-bold" style="width:120px; height:120px; font-size:36px;">
                        <?= strtoupper(substr($nama ?? 'Siswa', 0, 1)) ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <h5 class="fw-bold text-dark mb-1"><?= esc($nama) ?></h5>
            <p class="text-muted small mb-3">NIS: <?= esc(session()->get('username')) ?></p>

            <div class="p-3 bg-light rounded-3 border mb-3 text-start">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Total Poin Akumulasi:</span>
                    <strong class="fs-5 <?= $totalPoint >= 10 ? 'text-danger' : 'text-primary' ?>"><?= $totalPoint ?> Poin</strong>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar <?= $totalPoint >= 10 ? 'bg-danger' : 'bg-primary' ?>" role="progressbar" style="width: <?= min(100, $totalPoint * 10) ?>%"></div>
                </div>
                <div class="mt-2 text-muted small">
                    Batas Panggilan Orang Tua: <strong>10 Poin</strong>
                </div>
            </div>

            <?php if ($totalPoint >= 10): ?>
                <div class="alert alert-danger py-2 px-3 small border-0 rounded-3 text-start mb-0">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Perhatian: Poin Anda telah mencapai batas pemanggilan orang tua!
                </div>
            <?php else: ?>
                <div class="alert alert-success py-2 px-3 small border-0 rounded-3 text-start mb-0">
                    <i class="fa-solid fa-circle-check me-1"></i> Pertahankan kedisiplinan dan tata tertib sekolah Anda.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filter & Table Column -->
    <div class="col-12 col-lg-8">
        <div class="card-modern mb-4">
            <div class="card-modern-header">
                <h6 class="fw-bold mb-0">Filter Periode Catatan</h6>
            </div>
            <div class="card-modern-body p-3">
                <form method="POST" action="<?= site_url('main/data_pelanggaran_siswa') ?>" class="row g-2 align-items-end">
                    <?= csrf_field() ?>
                    <div class="col-12 col-sm-5">
                        <label class="form-label small" for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select form-select-sm">
                            <option value="">-- Semua Bulan --</option>
                            <?php 
                            $bulanArr = [
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            ];
                            foreach ($bulanArr as $val => $mName): ?>
                                <option value="<?= $val ?>"><?= $mName ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-5">
                        <label class="form-label small" for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="form-select form-select-sm">
                            <option value="">-- Semua Tahun --</option>
                            <?php 
                            $currY = (int)date('Y');
                            for ($y = $currY; $y >= 2016; $y--): ?>
                                <option value="<?= $y ?>"><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Daftar Pelanggaran Yang Tercatat</h5>
                <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($siswa) ?> Catatan</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Tanggal</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Sanksi Pembinaan</th>
                                <th style="width: 100px;" class="text-center">Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($siswa as $item): 
                                $tgl   = $item['tgl_pelanggaran'] ?? '';
                                $namaP = $item['nama_pelanggaran'] ?? '';
                                $snk   = $item['sanksi_pelanggaran'] ?? '-';
                                $pt    = (int)($item['point'] ?? 0);
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td><?= esc($tgl) ?></td>
                                <td><strong class="text-dark"><?= esc($namaP) ?></strong></td>
                                <td><small class="text-muted"><?= esc($snk) ?></small></td>
                                <td class="text-center">
                                    <span class="badge bg-danger text-white rounded-pill px-3 py-1 fw-bold">
                                        +<?= $pt ?> Poin
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
