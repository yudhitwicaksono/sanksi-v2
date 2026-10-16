<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-envelope-open-text text-danger me-2"></i>Penerbitan Surat Panggilan Orang Tua</h4>
            <p class="text-muted small mb-0">Daftar siswa yang telah mengakumulasi <strong>10 poin pelanggaran atau lebih</strong></p>
        </div>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Siswa Memenuhi Syarat Pemanggilan (≥ 10 Poin)</h5>
                <span class="badge bg-danger-subtle text-danger border rounded-pill">Total: <?= count($row) ?> Siswa</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Identitas Siswa</th>
                                <th>Kelas</th>
                                <th>Nama Wali Murid</th>
                                <th style="width: 130px;" class="text-center">Total Poin</th>
                                <th style="width: 140px;" class="text-center">Status Surat</th>
                                <th style="width: 160px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($row as $vaData): 
                                $nis    = $vaData['nis'];
                                $nama   = $vaData['nama_siswa'];
                                $kls    = $vaData['kelas'] . ' ' . $vaData['jurusan'] . ' ' . $vaData['no_kelas'];
                                $wali   = $vaData['nama_wali'] ?? '-';
                                $idWali = $vaData['id_wali_murid'] ?? '';
                                $poin   = (int)($vaData['point'] ?? 0);
                                $status = $vaData['status_surat'] ?? 'belum-dicetak';
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($nama) ?></div>
                                    <small class="text-muted">NIS: <?= esc($nis) ?></small>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary px-2 py-1"><?= esc($kls) ?></span></td>
                                <td><i class="fa-solid fa-user-tie small text-muted me-1"></i><?= esc($wali) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-danger text-white rounded-pill px-3 py-1 fw-bold fs-6">
                                        <?= $poin ?> Poin
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if ($status === 'sudah-dicetak'): ?>
                                        <span class="badge bg-success-subtle text-success border px-2 py-1">
                                            <i class="fa-solid fa-circle-check me-1"></i> Sudah Dicetak
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border px-2 py-1">
                                            <i class="fa-solid fa-clock me-1"></i> Belum Dicetak
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('main/surat_panggilan/' . $idWali . '/' . $nis) ?>" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-file-lines me-1"></i> Buat Surat
                                    </a>
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
