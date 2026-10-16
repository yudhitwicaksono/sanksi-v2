<?php 
$detail = !empty($siswa) ? (is_array($siswa) ? (isset($siswa[0]) ? $siswa[0] : $siswa) : $siswa) : [];
$nis     = is_array($detail) ? ($detail['nis'] ?? '') : ($detail->nis ?? '');
$namaS   = is_array($detail) ? ($detail['nama_siswa'] ?? '') : ($detail->nama_siswa ?? '');
$idKelas = is_array($detail) ? ($detail['id_kelas'] ?? '') : ($detail->id_kelas ?? '');
$tempat  = is_array($detail) ? ($detail['tempat_lahir'] ?? '') : ($detail->tempat_lahir ?? '');
$tgl     = is_array($detail) ? ($detail['tgl_lahir'] ?? '') : ($detail->tgl_lahir ?? '');
$alamat  = is_array($detail) ? ($detail['alamat_siswa'] ?? '') : ($detail->alamat_siswa ?? '');

$namaKelas = '';
foreach ($kelas as $k) {
    $kId = is_array($k) ? $k['id_kelas'] : $k->id_kelas;
    if ($kId == $idKelas) {
        $namaKelas = is_array($k) ? ($k['kelas'] . ' ' . $k['jurusan'] . ' ' . $k['no_kelas']) : ($k->kelas . ' ' . $k->jurusan . ' ' . $k->no_kelas);
        break;
    }
}
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-gear text-primary me-2"></i>Pengaturan Akun Siswa</h4>
            <p class="text-muted small mb-0">Perbarui informasi profil dan foto akun Anda</p>
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
                        <?= strtoupper(substr($namaS ?: 'S', 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <button type="button" class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0" data-bs-toggle="modal" data-bs-target="#uploadPhotoSiswaModal" title="Ganti Foto">
                    <i class="fa-solid fa-camera"></i>
                </button>
            </div>
            
            <h5 class="fw-bold text-dark mb-1"><?= esc($namaS) ?></h5>
            <p class="text-muted small mb-2">NIS: <?= esc($nis) ?></p>
            <span class="badge bg-secondary-subtle text-secondary px-3 py-1">
                Kelas: <?= esc($namaKelas ?: '-') ?>
            </span>
        </div>
    </div>

    <!-- Edit Info Form Column -->
    <div class="col-12 col-lg-8">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Informasi Pribadi Siswa</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/updateProfil') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="nis" value="<?= esc($nis) ?>">

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="nis_display">NIS (Nomor Induk Siswa)</label>
                            <input type="text" id="nis_display" value="<?= esc($nis) ?>" readonly class="form-control bg-light fw-bold">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="kelas_display">Kelas Terdaftar</label>
                            <input type="text" id="kelas_display" value="<?= esc($namaKelas) ?>" readonly class="form-control bg-light">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nama_siswa">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="nama_siswa" id="nama_siswa" value="<?= esc($namaS) ?>" required class="form-control">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?= esc($tempat) ?>" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="tgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" value="<?= esc($tgl) ?>" required class="form-control">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="alamat_siswa">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat_siswa" id="alamat_siswa" required class="form-control" rows="3"><?= esc($alamat) ?></textarea>
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
<div class="modal fade" id="uploadPhotoSiswaModal" tabindex="-1" aria-labelledby="uploadPhotoSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="<?= site_url('main/prosesuploadFoto') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="nis" value="<?= esc($nis) ?>">
                <input type="hidden" name="submit" value="upload">
                
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold" id="uploadPhotoSiswaModalLabel">Ganti Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label" for="userfile_siswa">Pilih Berkas Foto Baru (JPG/PNG, Maks. 2MB)</label>
                        <input type="file" name="userfile" id="userfile_siswa" required accept="image/png, image/jpeg" class="form-control">
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
