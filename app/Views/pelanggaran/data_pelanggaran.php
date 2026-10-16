<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>Daftar Kategori Pelanggaran</h4>
            <p class="text-muted small mb-0">Master data tata tertib dan bobot poin sanksi siswa SMAN 8 Bandung</p>
        </div>
        <a href="<?= site_url('main/input_pelanggaran') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Pelanggaran Baru
        </a>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Tabel Pelanggaran & Bobot Poin</h5>
                <span class="badge bg-danger-subtle text-danger border rounded-pill">Total: <?= count($pelanggaran) ?> Aturan</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 70px;" class="text-center">No</th>
                                <th>Deskripsi Pelanggaran</th>
                                <th style="width: 140px;" class="text-center">Bobot Poin</th>
                                <th style="width: 150px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($pelanggaran as $row): 
                                $id    = is_array($row) ? $row['id_pelanggaran'] : $row->id_pelanggaran;
                                $nama  = is_array($row) ? $row['nama_pelanggaran'] : $row->nama_pelanggaran;
                                $point = is_array($row) ? $row['point'] : $row->point;
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= esc($nama) ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold">
                                        <?= (int)$point ?> Poin
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= site_url('main/update_pelanggaran/' . $id) ?>" class="btn btn-outline-primary" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= site_url('main/hapus_peanggaran/' . $id) ?>" 
                                           class="btn btn-outline-danger" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggaran ini?')" 
                                           title="Hapus Data">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
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
