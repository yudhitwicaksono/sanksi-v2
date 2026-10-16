<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-plus-circle text-primary me-2"></i>Tambah Jenis Pelanggaran</h4>
            <p class="text-muted small mb-0">Definisikan aturan pelanggaran dan bobot sanksi kedisiplinan</p>
        </div>
        <a href="<?= site_url('main/data_pelanggaran') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Input Pelanggaran</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/insertPelanggaran') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label" for="nama_pelanggaran">Nama / Jenis Pelanggaran <span class="text-danger">*</span></label>
                        <textarea name="nama_pelanggaran" id="nama_pelanggaran" required class="form-control" rows="3" placeholder="Contoh: Merokok di lingkungan sekolah"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="point">Bobot Poin Pelanggaran <span class="text-danger">*</span></label>
                        <input type="number" min="1" max="100" name="point" id="point" required class="form-control" placeholder="Contoh: 10">
                        <div class="form-text small">Poin ini akan terakumulasi pada riwayat siswa setiap kali pelanggaran dicatat.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= site_url('main/data_pelanggaran') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Pelanggaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
