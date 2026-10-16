<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-plus text-primary me-2"></i>Tambah Staf Kedisiplinan</h4>
            <p class="text-muted small mb-0">Daftarkan akun staf/guru yang berwenang mencatat dan mengelola pelanggaran</p>
        </div>
        <a href="<?= site_url('main/bagian_kedisiplinan') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Data Staf</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/insertBagianKedisiplinan') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label" for="nip">NIP / Identitas Pegawai <span class="text-danger">*</span></label>
                        <input type="text" name="nip" id="nip" required class="form-control" placeholder="Contoh: 198501012010011001">
                        <div class="form-text small">NIP ini sekaligus akan digunakan sebagai username & password awal login.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nama_guru">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                        <input type="text" name="nama_guru" id="nama_guru" required class="form-control" placeholder="Nama lengkap guru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="alamat_guru">Alamat Tempat Tinggal <span class="text-danger">*</span></label>
                        <textarea name="alamat_guru" id="alamat_guru" required class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="no_hp">Nomor Handphone / WhatsApp <span class="text-danger">*</span></label>
                            <input type="tel" name="no_hp" id="no_hp" required class="form-control" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="email">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" required class="form-control" placeholder="nama@gmail.com">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= site_url('main/bagian_kedisiplinan') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Data Staf
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
