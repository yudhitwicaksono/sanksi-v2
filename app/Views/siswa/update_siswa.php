<?php 
$detail = !empty($siswa) ? (is_array($siswa) ? (isset($siswa[0]) ? $siswa[0] : $siswa) : $siswa) : [];
$nis     = is_array($detail) ? ($detail['nis'] ?? '') : ($detail->nis ?? '');
$nama    = is_array($detail) ? ($detail['nama_siswa'] ?? '') : ($detail->nama_siswa ?? '');
$idKelas = is_array($detail) ? ($detail['id_kelas'] ?? '') : ($detail->id_kelas ?? '');
$tempat  = is_array($detail) ? ($detail['tempat_lahir'] ?? '') : ($detail->tempat_lahir ?? '');
$tgl     = is_array($detail) ? ($detail['tgl_lahir'] ?? '') : ($detail->tgl_lahir ?? '');
$alamat  = is_array($detail) ? ($detail['alamat_siswa'] ?? '') : ($detail->alamat_siswa ?? '');
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-pen text-primary me-2"></i>Edit Data Siswa</h4>
            <p class="text-muted small mb-0">Perbarui informasi profil dan penempatan kelas siswa</p>
        </div>
        <a href="<?= site_url('main/siswa') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="col-12 col-md-8 col-lg-6">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Update Siswa</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/updateSiswa') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label" for="nis">NIS (Nomor Induk Siswa)</label>
                        <input type="text" name="nis" id="nis" value="<?= esc($nis) ?>" readonly class="form-control bg-light fw-bold">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nama_siswa">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="nama_siswa" id="nama_siswa" value="<?= esc($nama) ?>" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="id_kelas">Kelas <span class="text-danger">*</span></label>
                        <select name="id_kelas" id="id_kelas" required class="form-select">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($kelas as $row): 
                                $kId = is_array($row) ? $row['id_kelas'] : $row->id_kelas;
                                $kName = is_array($row) ? ($row['kelas'] . ' ' . $row['jurusan'] . ' ' . $row['no_kelas']) : ($row->kelas . ' ' . $row->jurusan . ' ' . $row->no_kelas);
                            ?>
                                <option value="<?= $kId ?>" <?= $kId == $idKelas ? 'selected' : '' ?>><?= esc($kName) ?></option>
                            <?php endforeach; ?>
                        </select>
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
                        <a href="<?= site_url('main/siswa') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
