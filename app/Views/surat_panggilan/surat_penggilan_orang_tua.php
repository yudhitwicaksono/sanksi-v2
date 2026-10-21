<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-envelope-open-text text-danger me-2"></i>Penerbitan Surat Panggilan Orang Tua</h4>
            <p class="text-muted small mb-0">Daftar siswa yang telah mengakumulasi <strong>10 poin pelanggaran atau lebih</strong></p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check fs-5 me-2 flex-shrink-0"></i>
            <div><?= session()->getFlashdata('success') ?></div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
            <i class="fa-solid fa-triangle-exclamation fs-5 me-2 flex-shrink-0"></i>
            <div><?= session()->getFlashdata('error') ?></div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

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
                                <th>Nama Wali Murid & Email</th>
                                <th style="width: 120px;" class="text-center">Total Poin</th>
                                <th style="width: 140px;" class="text-center">Status Surat</th>
                                <th style="width: 220px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($row as $vaData): 
                                $nis       = $vaData['nis'];
                                $nama      = $vaData['nama_siswa'];
                                $kls       = $vaData['kelas'] . ' ' . $vaData['jurusan'] . ' ' . $vaData['no_kelas'];
                                $wali      = $vaData['nama_wali'] ?? '-';
                                $emailWali = $vaData['email_wali'] ?? '';
                                $idWali    = $vaData['id_wali_murid'] ?? '';
                                $poin      = (int)($vaData['point'] ?? 0);
                                $status    = $vaData['status_surat'] ?? 'belum-dicetak';
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($nama) ?></div>
                                    <small class="text-muted">NIS: <?= esc($nis) ?></small>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary px-2 py-1"><?= esc($kls) ?></span></td>
                                <td>
                                    <div class="fw-semibold text-dark"><i class="fa-solid fa-user-tie small text-muted me-1"></i><?= esc($wali) ?></div>
                                    <?php if (!empty($emailWali)): ?>
                                        <small class="text-primary"><i class="fa-regular fa-envelope me-1"></i><?= esc($emailWali) ?></small>
                                    <?php else: ?>
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation me-1"></i>Email belum diisi</small>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger text-white rounded-pill px-3 py-1 fw-bold fs-6">
                                        <?= $poin ?> Poin
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if ($status === 'sudah-dikirim-email'): ?>
                                        <span class="badge bg-primary-subtle text-primary border px-2 py-1" title="Surat telah dikirim ke email wali murid">
                                            <i class="fa-solid fa-paper-plane me-1"></i> Email Terkirim
                                        </span>
                                    <?php elseif ($status === 'sudah-dicetak'): ?>
                                        <span class="badge bg-success-subtle text-success border px-2 py-1">
                                            <i class="fa-solid fa-circle-check me-1"></i> Sudah Dicetak
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border px-2 py-1">
                                            <i class="fa-solid fa-clock me-1"></i> Belum Diproses
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="<?= site_url('main/surat_panggilan/' . $idWali . '/' . $nis) ?>" 
                                           class="btn btn-sm btn-danger text-nowrap" 
                                           title="Buka Pratinjau & Cetak Surat Fisik">
                                            <i class="fa-solid fa-file-lines me-1"></i> Buat Surat
                                        </a>
                                        <a href="<?= site_url('main/kirim_email_surat/' . $idWali . '/' . $nis) ?>" 
                                           class="btn btn-sm btn-primary text-nowrap <?= empty($emailWali) ? 'disabled' : '' ?>" 
                                           onclick="return confirm('Kirim surat panggilan ini via email ke <?= esc($emailWali ?: 'wali murid') ?>?')"
                                           title="<?= !empty($emailWali) ? 'Kirim surat ke ' . esc($emailWali) : 'Email wali murid belum diisi' ?>">
                                            <i class="fa-solid fa-paper-plane me-1"></i> Kirim Email
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
