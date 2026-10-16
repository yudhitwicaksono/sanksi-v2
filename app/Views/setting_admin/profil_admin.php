<?php 
$detail = !empty($bagian_kedisiplinan) ? (is_array($bagian_kedisiplinan) ? (isset($bagian_kedisiplinan[0]) ? $bagian_kedisiplinan[0] : $bagian_kedisiplinan) : $bagian_kedisiplinan) : [];
$nip    = is_array($detail) ? ($detail['nip'] ?? '') : ($detail->nip ?? '');
$namaG  = is_array($detail) ? ($detail['nama_guru'] ?? '') : ($detail->nama_guru ?? '');
$alamat = is_array($detail) ? ($detail['alamat_guru'] ?? '') : ($detail->alamat_guru ?? '');
$noHp   = is_array($detail) ? ($detail['no_hp'] ?? '') : ($detail->no_hp ?? '');
$email  = is_array($detail) ? ($detail['email'] ?? '') : ($detail->email ?? '');
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-gear text-primary me-2"></i>Pengaturan Akun Staf / Admin</h4>
            <p class="text-muted small mb-0">Perbarui identitas pribadi, kontak, dan foto profil Anda</p>
        </div>
    </div>

    <!-- Profile Photo Column -->
    <div class="col-12 col-lg-4">
        <div class="card-modern text-center p-4">
            <div class="mb-3 position-relative d-inline-block">
                <?php if (!empty($foto) && file_exists(FCPATH . 'img/' . $foto)): ?>
                    <img src="<?= base_url('img/' . $foto) ?>" class="rounded-circle shadow" width="130" height="130" style="object-fit:cover;">
                <?php else: ?>
                    <div class="rounded-circle bg-light border mx-auto d-flex align-items-center justify-content-center text-primary fw-bold" style="width:130px; height:130px; font-size:42px;">
                        <?= strtoupper(substr($namaG ?: 'A', 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <button type="button" class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0" data-bs-toggle="modal" data-bs-target="#uploadPhotoAdminModal" title="Ganti Foto">
                    <i class="fa-solid fa-camera"></i>
                </button>
            </div>
            
            <h5 class="fw-bold text-dark mb-1"><?= esc($namaG) ?></h5>
            <p class="text-muted small mb-2">NIP: <?= esc($nip) ?></p>
            <span class="badge bg-primary-subtle text-primary border px-3 py-1">
                <?= esc(session()->get('role') ?? 'Bagian Kedisiplinan') ?>
            </span>
        </div>
    </div>

    <!-- Edit Info Form Column -->
    <div class="col-12 col-lg-8">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Informasi Pribadi & Kontak</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/updateBagianKedisiplinanP') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="nip" value="<?= esc($nip) ?>">

                    <div class="mb-3">
                        <label class="form-label" for="nip_display">NIP / Identitas Pegawai</label>
                        <input type="text" id="nip_display" value="<?= esc($nip) ?>" readonly class="form-control bg-light fw-bold">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nama_guru">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                        <input type="text" name="nama_guru" id="nama_guru" value="<?= esc($namaG) ?>" required class="form-control">
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
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Upload Photo Modal -->
<div class="modal fade" id="uploadPhotoAdminModal" tabindex="-1" aria-labelledby="uploadPhotoAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="<?= site_url('main/prosesuploadFotoA') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="nip" value="<?= esc($nip) ?>">
                <input type="hidden" name="submit" value="upload">
                
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold" id="uploadPhotoAdminModalLabel">Ganti Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label" for="userfile_admin">Pilih Berkas Foto Baru (JPG/PNG, Maks. 2MB)</label>
                        <input type="file" name="userfile" id="userfile_admin" required accept="image/png, image/jpeg" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Unggah Foto Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>
