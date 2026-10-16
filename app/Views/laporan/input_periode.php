<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-file-invoice text-primary me-2"></i>Rekapitulasi Laporan Pelanggaran</h4>
            <p class="text-muted small mb-0">Tentukan kriteria periode dan filter kelas untuk mencetak rekap data pelanggaran siswa</p>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Filter Parameter Laporan</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/ViewLaporan') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label" for="id_kelas">Target Kelas <span class="text-danger">*</span></label>
                        <select name="id_kelas" id="id_kelas" required class="form-select">
                            <option value="semua-kelas">-- Semua Kelas --</option>
                            <?php foreach ($kelas as $row): 
                                $kId = is_array($row) ? $row['id_kelas'] : $row->id_kelas;
                                $kName = is_array($row) ? ($row['kelas'] . ' ' . $row['jurusan'] . ' ' . $row['no_kelas']) : ($row->kelas . ' ' . $row->jurusan . ' ' . $row->no_kelas);
                            ?>
                                <option value="<?= $kId ?>"><?= esc($kName) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" required class="form-select">
                                <option value="semua-bulan">-- Semua Bulan --</option>
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
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" required class="form-select">
                                <option value="semua-tahun">-- Semua Tahun --</option>
                                <?php 
                                $currY = (int)date('Y');
                                for ($y = $currY; $y >= 2016; $y--): ?>
                                    <option value="<?= $y ?>"><?= $y ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> Lihat Rekap Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
