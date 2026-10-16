<?php 
$detail = !empty($wali_murid) ? (is_array($wali_murid) ? (isset($wali_murid[0]) ? $wali_murid[0] : $wali_murid) : $wali_murid) : [];
$idWali = is_array($detail) ? ($detail['id_wali_murid'] ?? '') : ($detail->id_wali_murid ?? '');
$nama   = is_array($detail) ? ($detail['nama_wali'] ?? '') : ($detail->nama_wali ?? '');
$alamat = is_array($detail) ? ($detail['alamat_wali'] ?? '') : ($detail->alamat_wali ?? '');
$noHp   = is_array($detail) ? ($detail['no_hp_wali'] ?? '') : ($detail->no_hp_wali ?? '');
$email  = is_array($detail) ? ($detail['email_wali'] ?? '') : ($detail->email_wali ?? '');
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-pen text-primary me-2"></i>Perbarui Data Wali Murid</h4>
            <p class="text-muted small mb-0">Ubah kontak dan alamat orang tua / wali siswa</p>
        </div>
        <a href="<?= site_url('main/data_wali_murid') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Update Wali Murid</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/updateWali') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label" for="id_wali_murid">ID Wali</label>
                        <input type="text" name="id_wali_murid" id="id_wali_murid" value="<?= esc($idWali) ?>" readonly class="form-control bg-light fw-bold">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nama_wali">Nama Lengkap Wali <span class="text-danger">*</span></label>
                        <input type="text" name="nama_wali" id="nama_wali" value="<?= esc($nama) ?>" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="alamat_wali">Alamat Wali Siswa <span class="text-danger">*</span></label>
                        <textarea name="alamat_wali" id="alamat_wali" required class="form-control" rows="3"><?= esc($alamat) ?></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="no_hp_wali">Nomor Handphone / WA <span class="text-danger">*</span></label>
                            <input type="tel" name="no_hp_wali" id="no_hp_wali" value="<?= esc($noHp) ?>" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="email_wali">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email_wali" id="email_wali" value="<?= esc($email) ?>" required class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= site_url('main/data_wali_murid') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
