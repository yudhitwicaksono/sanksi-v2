<?php 
$detail = !empty($pelanggaran) ? (is_array($pelanggaran) ? (isset($pelanggaran[0]) ? $pelanggaran[0] : $pelanggaran) : $pelanggaran) : [];
$id    = is_array($detail) ? ($detail['id_pelanggaran'] ?? '') : ($detail->id_pelanggaran ?? '');
$nama  = is_array($detail) ? ($detail['nama_pelanggaran'] ?? '') : ($detail->nama_pelanggaran ?? '');
$point = is_array($detail) ? ($detail['point'] ?? '') : ($detail->point ?? '');
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-pen-to-square text-primary me-2"></i>Edit Jenis Pelanggaran</h4>
            <p class="text-muted small mb-0">Perbarui deskripsi pelanggaran atau bobot poin</p>
        </div>
        <a href="<?= site_url('main/data_pelanggaran') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Update Pelanggaran</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/updatePelanggaran') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_pelanggaran" value="<?= esc($id) ?>">
                    
                    <div class="mb-3">
                        <label class="form-label" for="nama_pelanggaran">Nama / Jenis Pelanggaran <span class="text-danger">*</span></label>
                        <textarea name="nama_pelanggaran" id="nama_pelanggaran" required class="form-control" rows="3"><?= esc($nama) ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="point">Bobot Poin Pelanggaran <span class="text-danger">*</span></label>
                        <input type="number" min="1" max="100" name="point" id="point" value="<?= esc($point) ?>" required class="form-control">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= site_url('main/data_pelanggaran') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
