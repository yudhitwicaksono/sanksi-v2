<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-school text-primary me-2"></i>Data Kelas</h4>
            <p class="text-muted small mb-0">Kelola daftar tingkatan, jurusan, dan nomor kelas di SMAN 8 Bandung</p>
        </div>
        <a href="<?= site_url('main/input_data_kelas') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Tambah Kelas Baru
        </a>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-modern-header">
                <h5 class="fw-bold mb-0">Daftar Kelas Terdaftar</h5>
                <span class="badge bg-primary-subtle text-primary border rounded-pill">Total: <?= count($kelas) ?> Kelas</span>
            </div>
            <div class="card-modern-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover table-modern datatable align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 70px;" class="text-center">No</th>
                                <th>Tingkat</th>
                                <th>Jurusan</th>
                                <th>Nomor Kelas</th>
                                <th>Nama Lengkap</th>
                                <th style="width: 120px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($kelas as $row): 
                                $idKelas = is_array($row) ? $row['id_kelas'] : $row->id_kelas;
                                $tingkat = is_array($row) ? $row['kelas'] : $row->kelas;
                                $jurusan = is_array($row) ? $row['jurusan'] : $row->jurusan;
                                $noKelas = is_array($row) ? $row['no_kelas'] : $row->no_kelas;
                            ?>
                            <tr>
                                <td class="text-center fw-semibold text-muted"><?= $no++ ?></td>
                                <td><span class="badge bg-secondary-subtle text-secondary px-2 py-1"><?= esc($tingkat) ?></span></td>
                                <td class="fw-semibold"><?= esc($jurusan) ?></td>
                                <td>Kelas <?= esc($noKelas) ?></td>
                                <td><strong class="text-primary"><?= esc($tingkat . ' ' . $jurusan . ' ' . $noKelas) ?></strong></td>
                                <td class="text-center">
                                    <a href="<?= site_url('main/hapusKelas/' . $idKelas) ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini? Data terkait siswa mungkin akan terpengaruh.')" 
                                       title="Hapus Kelas">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
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
