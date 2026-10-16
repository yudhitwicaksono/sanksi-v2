<?php 
$cari = ($wali_murid ?? 0) + 1; 
$idWaliAuto = "WM-" . $cari; 
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-plus text-primary me-2"></i>Pendaftaran Siswa Baru</h4>
            <p class="text-muted small mb-0">Input data lengkap siswa beserta identitas kontak orang tua / wali</p>
        </div>
        <a href="<?= site_url('main/siswa') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="col-12">
        <form action="<?= site_url('main/insertSiswa') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row g-4">
                <!-- Data Siswa -->
                <div class="col-12 col-lg-6">
                    <div class="card-modern h-100">
                        <div class="card-modern-header bg-light">
                            <h5 class="fw-bold mb-0 text-primary"><i class="fa-solid fa-id-card me-2"></i>Data Pribadi Siswa</h5>
                        </div>
                        <div class="card-modern-body">
                            <div class="mb-3">
                                <label class="form-label" for="nis">Nomor Induk Siswa (NIS) <span class="text-danger">*</span></label>
                                <input type="text" name="nis" id="nis" required class="form-control" placeholder="Nomor NIS siswa">
                                <div class="form-text small">NIS ini akan dijadikan username & kata sandi awal akun siswa.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="nama_siswa">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                                <input type="text" name="nama_siswa" id="nama_siswa" required class="form-control" placeholder="Nama lengkap">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label" for="id_kelas">Kelas <span class="text-danger">*</span></label>
                                    <select name="id_kelas" id="id_kelas" required class="form-select">
                                        <option value="">-- Pilih Kelas --</option>
                                        <?php foreach ($kelas as $row): 
                                            $idKls = is_array($row) ? $row['id_kelas'] : $row->id_kelas;
                                            $textKls = is_array($row) ? ($row['kelas'] . ' ' . $row['jurusan'] . ' ' . $row['no_kelas']) : ($row->kelas . ' ' . $row->jurusan . ' ' . $row->no_kelas);
                                        ?>
                                            <option value="<?= $idKls ?>"><?= esc($textKls) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label" for="tahun_ajaran_masuk">Tahun Masuk <span class="text-danger">*</span></label>
                                    <select name="tahun_ajaran_masuk" id="tahun_ajaran_masuk" required class="form-select">
                                        <?php 
                                        $currY = (int)date('Y');
                                        for ($y = $currY; $y >= 2000; $y--): ?>
                                            <option value="<?= $y ?>"><?= $y ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label" for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" required class="form-control" placeholder="Kota lahir">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label" for="tgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" required class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="alamat_siswa">Alamat Lengkap Siswa <span class="text-danger">*</span></label>
                                <textarea name="alamat_siswa" id="alamat_siswa" required class="form-control" rows="3" placeholder="Alamat domisili siswa"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Wali -->
                <div class="col-12 col-lg-6">
                    <div class="card-modern h-100">
                        <div class="card-modern-header bg-light">
                            <h5 class="fw-bold mb-0 text-success"><i class="fa-solid fa-user-group me-2"></i>Data Orang Tua / Wali Murid</h5>
                        </div>
                        <div class="card-modern-body">
                            <div class="mb-3">
                                <label class="form-label" for="id_wali_murid">ID Wali</label>
                                <input type="text" name="id_wali_murid" id="id_wali_murid" value="<?= esc($idWaliAuto) ?>" readonly class="form-control bg-light fw-bold">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="nama_wali">Nama Lengkap Wali <span class="text-danger">*</span></label>
                                <input type="text" name="nama_wali" id="nama_wali" required class="form-control" placeholder="Nama ayah / ibu / wali">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label" for="no_hp_wali">No. HP / WA Wali <span class="text-danger">*</span></label>
                                    <input type="tel" name="no_hp_wali" id="no_hp_wali" required class="form-control" placeholder="08xxxxxxxxxx">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label" for="email_wali">Email Wali <span class="text-danger">*</span></label>
                                    <input type="email" name="email_wali" id="email_wali" required class="form-control" placeholder="wali@gmail.com">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="alamat_wali">Alamat Wali Siswa <span class="text-danger">*</span></label>
                                <textarea name="alamat_wali" id="alamat_wali" required class="form-control" rows="3" placeholder="Alamat tempat tinggal orang tua"></textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                <a href="<?= site_url('main/siswa') ?>" class="btn btn-light border px-4">Batal</a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Siswa & Wali
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
