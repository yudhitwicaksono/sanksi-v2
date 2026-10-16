<?php 
$col = !empty($field) ? (is_array($field) ? (isset($field[0]) ? $field[0] : $field) : $field) : [];
$idHistory     = $col['id_history'] ?? '';
$foto          = $col['foto'] ?? '';
$nama          = $col['nama_siswa'] ?? '';
$nis           = $col['nis'] ?? '';
$sanksi        = $col['sanksi_pelanggaran'] ?? '';
$tanggal       = $col['tgl_pelanggaran'] ?? '';
$kelas         = $col['kelas'] ?? '';
$jurusan       = $col['jurusan'] ?? '';
$noKelas       = $col['no_kelas'] ?? '';
$idPelanggaran = $col['id_pelanggaran'] ?? '';
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-pen-to-square text-primary me-2"></i>Edit Catatan Pelanggaran</h4>
            <p class="text-muted small mb-0">Koreksi tanggal, jenis pelanggaran, atau sanksi pembinaan yang diberikan</p>
        </div>
        <a href="<?= site_url('main/lihat_pelanggaran') ?>" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Riwayat
        </a>
    </div>

    <!-- Student Info Column -->
    <div class="col-12 col-lg-4">
        <div class="card-modern text-center p-4">
            <div class="mb-3 position-relative d-inline-block">
                <?php if (!empty($foto) && file_exists(FCPATH . 'img/' . $foto)): ?>
                    <img src="<?= base_url('img/' . $foto) ?>" class="rounded-circle shadow" width="130" height="130" style="object-fit:cover;">
                <?php else: ?>
                    <div class="rounded-circle bg-light border mx-auto d-flex align-items-center justify-content-center text-primary fw-bold" style="width:130px; height:130px; font-size:42px;">
                        <?= strtoupper(substr($nama, 0, 1)) ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <h5 class="fw-bold text-dark mb-1"><?= esc($nama) ?></h5>
            <p class="text-muted small mb-2">NIS: <?= esc($nis) ?></p>
            <span class="badge bg-secondary-subtle text-secondary px-3 py-1">
                Kelas <?= esc($kelas . ' ' . $jurusan . ' ' . $noKelas) ?>
            </span>
        </div>
    </div>

    <!-- Edit Form Column -->
    <div class="col-12 col-lg-8">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Formulir Koreksi Data Pelanggaran</h5>
            </div>
            <div class="card-modern-body">
                <form action="<?= site_url('main/editPelanggaranM/' . $idHistory) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="nis" value="<?= esc($nis) ?>">

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="tgl_pelanggaran">Tanggal Pelanggaran <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_pelanggaran" id="tgl_pelanggaran" max="<?= date('Y-m-d') ?>" value="<?= esc($tanggal) ?>" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label" for="id_pelanggaran">Jenis Pelanggaran <span class="text-danger">*</span></label>
                            <select name="id_pelanggaran" id="id_pelanggaran" required class="form-select">
                                <?php foreach ($pelanggaran as $p): 
                                    $pId = is_array($p) ? $p['id_pelanggaran'] : $p->id_pelanggaran;
                                    $pNama = is_array($p) ? $p['nama_pelanggaran'] : $p->nama_pelanggaran;
                                    $pPoint = is_array($p) ? $p['point'] : $p->point;
                                ?>
                                    <option value="<?= $pId ?>" <?= $pId == $idPelanggaran ? 'selected' : '' ?>>
                                        <?= esc($pNama) ?> (<?= $pPoint ?> Poin)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="sanksi">Sanksi Pembinaan <span class="text-danger">*</span></label>
                        <textarea name="sanksi" id="sanksi" required class="form-control" rows="3"><?= esc($sanksi) ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= site_url('main/lihat_pelanggaran') ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
