<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-plus-circle text-primary me-2"></i>Tambah Kelas Baru</h4>
            <p class="text-muted small mb-0">Tambahkan konfigurasi kelas untuk siswa SMAN 8 Bandung</p>
        </div>
        <a href="<?= site_url('main/kelas') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Kelas
        </a>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Input Kelas</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/insertKelas') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label" for="kelas">Tingkat Kelas <span class="text-danger">*</span></label>
                        <select name="kelas" id="kelas" required class="form-select">
                            <option value="">-- Pilih Tingkat Kelas --</option>
                            <option value="X">Kelas X (Sepuluh)</option>
                            <option value="XI">Kelas XI (Sebelas)</option>
                            <option value="XII">Kelas XII (Dua Belas)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="jurusan">Peminatan / Jurusan <span class="text-danger">*</span></label>
                        <select name="jurusan" id="jurusan" required class="form-select">
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="MIPA">MIPA (Matematika & IPA)</option>
                            <option value="IPS">IPS (Ilmu Pengetahuan Sosial)</option>
                            <option value="Bahasa">Bahasa & Budaya</option>
                            <option value="-">- (Umum)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="no_kelas">Nomor Rombel / Kelas <span class="text-danger">*</span></label>
                        <select name="no_kelas" id="no_kelas" required class="form-select">
                            <option value="">-- Pilih Nomor --</option>
                            <?php for ($n = 1; $n <= 12; $n++): ?>
                                <option value="<?= $n ?>"><?= $n ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= site_url('main/kelas') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Data Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
