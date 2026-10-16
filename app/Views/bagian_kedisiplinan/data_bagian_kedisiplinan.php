<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-user-shield text-primary me-2"></i>Bagian Kedisiplinan</h4>
            <p class="text-muted small mb-0">Kelola akun dan data guru/staf bagian kedisiplinan dan tata tertib sekolah</p>
        </div>
        <a href="<?= site_url('main/input_bagian_kedisiplinan') ?>" class="btn btn-primary">
            <i class="fa-solid fa-user-plus me-1"></i> Tambah Staf Baru
        </a>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Daftar Guru / Staf Kedisiplinan</h5>
                <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($bagian_kedisiplinan) ?> Akun</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 70px;" class="text-center">No</th>
                                <th>NIP</th>
                                <th>Nama Guru / Staf</th>
                                <th>Kontak HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th style="width: 100px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($bagian_kedisiplinan as $row): 
                                $nip    = is_array($row) ? $row['nip'] : $row->nip;
                                $nama   = is_array($row) ? $row['nama_guru'] : $row->nama_guru;
                                $alamat = is_array($row) ? $row['alamat_guru'] : $row->alamat_guru;
                                $noHp   = is_array($row) ? $row['no_hp'] : $row->no_hp;
                                $email  = is_array($row) ? $row['email'] : $row->email;
                                $foto   = is_array($row) ? ($row['foto'] ?? '') : ($row->foto ?? '');
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td><code class="text-dark fw-bold"><?= esc($nip) ?></code></td>
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
                                <td><i class="fa-solid fa-phone small text-muted me-1"></i><?= esc($noHp) ?></td>
                                <td><i class="fa-regular fa-envelope small text-muted me-1"></i><?= esc($email) ?></td>
                                <td><small class="text-muted"><?= esc($alamat) ?></small></td>
                                <td class="text-center">
                                    <a href="<?= site_url('main/uBagianKedisiplinan/' . $nip) ?>" class="btn btn-sm btn-outline-primary" title="Edit Data">
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
