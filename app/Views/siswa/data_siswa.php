<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-users text-primary me-2"></i>Data Siswa</h4>
            <p class="text-muted small mb-0">Daftar seluruh siswa aktif SMAN 8 Bandung beserta kelas dan data wali</p>
        </div>
        <a href="<?= site_url('main/input_siswa') ?>" class="btn btn-primary">
            <i class="fa-solid fa-user-plus me-1"></i> Tambah Siswa Baru
        </a>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Tabel Data Siswa</h5>
                <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($siswa) ?> Siswa</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Nama Wali</th>
                                <th>Tempat & Tgl Lahir</th>
                                <th>Alamat</th>
                                <th style="width: 90px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($siswa as $row): 
                                $nis    = is_array($row) ? $row['nis'] : $row->nis;
                                $nama   = is_array($row) ? $row['nama_siswa'] : $row->nama_siswa;
                                $wali   = is_array($row) ? ($row['nama_wali'] ?? '-') : ($row->nama_wali ?? '-');
                                $kls    = is_array($row) ? ($row['kelas'] . ' ' . $row['jurusan'] . ' ' . $row['no_kelas']) : ($row->kelas . ' ' . $row->jurusan . ' ' . $row->no_kelas);
                                $ttl    = is_array($row) ? ($row['tempat_lahir'] . ', ' . $row['tgl_lahir']) : ($row->tempat_lahir . ', ' . $row->tgl_lahir);
                                $alamat = is_array($row) ? $row['alamat_siswa'] : $row->alamat_siswa;
                                $foto   = is_array($row) ? ($row['foto'] ?? '') : ($row->foto ?? '');
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td><code class="text-dark fw-bold"><?= esc($nis) ?></code></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <?php if (!empty($foto) && file_exists(FCPATH . 'img/' . $foto)): ?>
                                            <img src="<?= base_url('img/' . $foto) ?>" class="rounded-circle" width="32" height="32" style="object-fit:cover;">
                                        <?php else: ?>
                                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-primary fw-bold" style="width:32px; height:32px; font-size:12px;">
                                                <?= strtoupper(substr($nama, 0, 1)) ?>
                                            </div>
                                        <?php endif; ?>
                                        <span class="fw-semibold"><?= esc($nama) ?></span>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary-subtle text-secondary px-2 py-1"><?= esc($kls) ?></span></td>
                                <td><i class="fa-solid fa-user-tie small text-muted me-1"></i><?= esc($wali) ?></td>
                                <td><small class="text-muted"><?= esc($ttl) ?></small></td>
                                <td><small class="text-muted"><?= esc($alamat) ?></small></td>
                                <td class="text-center">
                                    <a href="<?= site_url('main/update_siswa/' . $nis) ?>" class="btn btn-sm btn-outline-primary" title="Edit Data Siswa">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
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
