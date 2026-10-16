<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>Riwayat Catatan Pelanggaran Siswa</h4>
            <p class="text-muted small mb-0">Semua catatan pelanggaran tata tertib siswa SMAN 8 Bandung</p>
        </div>
        <a href="<?= site_url('main/PelanggaranSiswa') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Input Pelanggaran Baru
        </a>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Tabel Seluruh Pelanggaran</h5>
                <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($siswa) ?> Catatan</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Identitas Siswa</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Pelanggaran</th>
                                <th>Sanksi Pembinaan</th>
                                <th style="width: 120px;" class="text-center">Poin</th>
                                <th style="width: 120px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($siswa as $vaData): 
                                $idHistory = $vaData['id_history'];
                                $nis       = $vaData['nis'];
                                $nama      = $vaData['nama_siswa'];
                                $kls       = $vaData['kelas'] . ' ' . $vaData['jurusan'] . ' ' . $vaData['no_kelas'];
                                $tgl       = $vaData['tgl_pelanggaran'];
                                $pel       = $vaData['nama_pelanggaran'];
                                $sanksi    = $vaData['sanksi_pelanggaran'] ?? '-';
                                $point     = (int)$vaData['point'];
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($nama) ?></div>
                                    <small class="text-muted">NIS: <?= esc($nis) ?></small>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary px-2 py-1"><?= esc($kls) ?></span></td>
                                <td><i class="fa-regular fa-calendar small text-muted me-1"></i><?= esc($tgl) ?></td>
                                <td><strong class="text-dark"><?= esc($pel) ?></strong></td>
                                <td><small class="text-muted"><?= esc($sanksi) ?></small></td>
                                <td class="text-center">
                                    <span class="badge bg-danger text-white rounded-pill px-3 py-1 fw-bold">
                                        +<?= $point ?> Poin
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= site_url('main/update_h_pelanggaran/' . $idHistory) ?>" class="btn btn-outline-primary" title="Edit Catatan">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= site_url('main/hapus_h_pelanggaran/' . $idHistory) ?>" 
                                           class="btn btn-outline-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus catatan pelanggaran ini?')" 
                                           title="Hapus Catatan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
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
