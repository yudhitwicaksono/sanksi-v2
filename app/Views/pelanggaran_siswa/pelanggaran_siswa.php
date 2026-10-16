<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-pen-to-square text-primary me-2"></i>Pencatatan Pelanggaran Siswa</h4>
            <p class="text-muted small mb-0">Cari siswa berdasarkan NIS atau filter kelas untuk mencatat pelanggaran kedisiplinan</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="col-12">
        <div class="card-modern p-3">
            <form method="POST" action="<?= site_url('main/PelanggaranSiswa') ?>" class="row g-3 align-items-end">
                <?= csrf_field() ?>
                <div class="col-12 col-md-5">
                    <label class="form-label" for="nis">Cari Berdasarkan NIS</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="nis" id="nis" class="form-control border-start-0" placeholder="Masukkan nomor NIS siswa...">
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <label class="form-label" for="id_kelas">Filter Berdasarkan Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-select">
                        <option value="">-- Semua Kelas --</option>
                        <?php foreach ($kelas as $row): 
                            $kId = is_array($row) ? $row['id_kelas'] : $row->id_kelas;
                            $kName = is_array($row) ? ($row['kelas'] . ' ' . $row['jurusan'] . ' ' . $row['no_kelas']) : ($row->kelas . ' ' . $row->jurusan . ' ' . $row->no_kelas);
                        ?>
                            <option value="<?= $kId ?>"><?= esc($kName) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-filter me-1"></i> Terapkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Cards / Table -->
    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Daftar Siswa</h5>
                <span class="badge bg-primary-subtle text-primary border rounded-pill">Ditemukan: <?= count($siswa) ?> Siswa</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Wali Murid</th>
                                <th>Kontak Wali</th>
                                <th style="width: 170px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($siswa as $row): 
                                $nis    = is_array($row) ? $row['nis'] : $row->nis;
                                $nama   = is_array($row) ? $row['nama_siswa'] : $row->nama_siswa;
                                $kls    = is_array($row) ? ($row['kelas'] . ' ' . $row['jurusan'] . ' ' . $row['no_kelas']) : ($row->kelas . ' ' . $row->jurusan . ' ' . $row->no_kelas);
                                $wali   = is_array($row) ? ($row['nama_wali'] ?? '-') : ($row->nama_wali ?? '-');
                                $noHp   = is_array($row) ? ($row['no_hp_wali'] ?? '-') : ($row->no_hp_wali ?? '-');
                                $foto   = is_array($row) ? ($row['foto'] ?? '') : ($row->foto ?? '');
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if (!empty($foto) && file_exists(FCPATH . 'img/' . $foto)): ?>
                                            <img src="<?= base_url('img/' . $foto) ?>" class="rounded-circle" width="38" height="38" style="object-fit:cover;">
                                        <?php else: ?>
                                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-primary fw-bold" style="width:38px; height:38px; font-size:13px;">
                                                <?= strtoupper(substr($nama, 0, 1)) ?>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold text-dark"><?= esc($nama) ?></div>
                                            <small class="text-muted">NIS: <?= esc($nis) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary px-2 py-1"><?= esc($kls) ?></span></td>
                                <td><?= esc($wali) ?></td>
                                <td><i class="fa-solid fa-phone small text-muted me-1"></i><?= esc($noHp) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('main/i_pelanggaran_siswa/' . $nis) ?>" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-pen-to-square me-1"></i> Input Sanksi
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
