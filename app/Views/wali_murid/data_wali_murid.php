<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-group text-primary me-2"></i>Data Wali Murid</h4>
            <p class="text-muted small mb-0">Informasi kontak orang tua / wali siswa untuk keperluan surat pemanggilan</p>
        </div>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Daftar Wali Murid</h5>
                <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($data_wali_murid) ?> Data</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 70px;" class="text-center">No</th>
                                <th>ID Wali</th>
                                <th>Nama Wali</th>
                                <th>Alamat</th>
                                <th>No. Handphone</th>
                                <th>Email</th>
                                <th style="width: 100px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($data_wali_murid as $row): 
                                $idWali = is_array($row) ? $row['id_wali_murid'] : $row->id_wali_murid;
                                $nama   = is_array($row) ? $row['nama_wali'] : $row->nama_wali;
                                $alamat = is_array($row) ? $row['alamat_wali'] : $row->alamat_wali;
                                $noHp   = is_array($row) ? $row['no_hp_wali'] : $row->no_hp_wali;
                                $email  = is_array($row) ? $row['email_wali'] : $row->email_wali;
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td><code class="text-dark fw-bold"><?= esc($idWali) ?></code></td>
                                <td class="fw-semibold"><?= esc($nama) ?></td>
                                <td><small class="text-muted"><?= esc($alamat) ?></small></td>
                                <td><i class="fa-solid fa-phone small text-muted me-1"></i><?= esc($noHp) ?></td>
                                <td><i class="fa-regular fa-envelope small text-muted me-1"></i><?= esc($email) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('main/update_wali_murid/' . $idWali) ?>" class="btn btn-sm btn-outline-primary" title="Edit Data Wali">
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
