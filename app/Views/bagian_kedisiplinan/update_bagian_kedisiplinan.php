<?php 
$detail = !empty($bagian_kedisiplinan) ? (is_array($bagian_kedisiplinan) ? (isset($bagian_kedisiplinan[0]) ? $bagian_kedisiplinan[0] : $bagian_kedisiplinan) : $bagian_kedisiplinan) : [];
$nip    = is_array($detail) ? ($detail['nip'] ?? '') : ($detail->nip ?? '');
$nama   = is_array($detail) ? ($detail['nama_guru'] ?? '') : ($detail->nama_guru ?? '');
$alamat = is_array($detail) ? ($detail['alamat_guru'] ?? '') : ($detail->alamat_guru ?? '');
$noHp   = is_array($detail) ? ($detail['no_hp'] ?? '') : ($detail->no_hp ?? '');
$email  = is_array($detail) ? ($detail['email'] ?? '') : ($detail->email ?? '');
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-pen text-primary me-2"></i>Perbarui Data Staf</h4>
            <p class="text-muted small mb-0">Ubah informasi staf kedisiplinan</p>
        </div>
        <a href="<?= site_url('main/bagian_kedisiplinan') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Update Data</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/updateBagianKedisiplinan') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label" for="nip">NIP (Tidak dapat diubah)</label>
                        <input type="text" name="nip" id="nip" value="<?= esc($nip) ?>" readonly class="form-control bg-light fw-bold">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nama_guru">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                        <input type="text" name="nama_guru" id="nama_guru" value="<?= esc($nama) ?>" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="alamat_guru">Alamat Tempat Tinggal <span class="text-danger">*</span></label>
                        <textarea name="alamat_guru" id="alamat_guru" required class="form-control" rows="3"><?= esc($alamat) ?></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="no_hp">Nomor Handphone / WhatsApp <span class="text-danger">*</span></label>
                            <input type="tel" name="no_hp" id="no_hp" value="<?= esc($noHp) ?>" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="email">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" value="<?= esc($email) ?>" required class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= site_url('main/bagian_kedisiplinan') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
