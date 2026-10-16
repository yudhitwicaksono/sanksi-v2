<?php 
$strKelas = "Semua Kelas";
if ($id_kelas !== 'semua-kelas' && !empty($kelas)) {
    foreach ($kelas as $k) {
        $strKelas = "Kelas " . $k['kelas'] . " " . $k['jurusan'] . " " . $k['no_kelas'];
    }
}
$paramPrint = ($id_kelas ?? 'semua-kelas') . "_" . ($bulan ?? 'semua-bulan') . "_" . ($tahun ?? 'semua-tahun');
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-file-invoice text-primary me-2"></i>Hasil Rekap Laporan Pelanggaran</h4>
            <p class="text-muted small mb-0">Periode: <?= esc($bulan) ?> / <?= esc($tahun) ?> &bull; Filter: <?= esc($strKelas) ?></p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= site_url('main/input_periode') ?>" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Ubah Filter
            </a>
            <a href="<?= site_url('main/viewPrint/' . $paramPrint) ?>" target="_blank" class="btn btn-danger">
                <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
            </a>
        </div>
    </div>

    <!-- Letter-like Preview Card -->
    <div class="col-12 col-xl-11 mx-auto">
        <div class="card-modern shadow-lg p-5 bg-white" style="border: 2px solid #e2e8f0; font-family: 'Times New Roman', Times, serif;">
            
            <!-- Kop Surat -->
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4" style="border-bottom: 3px double #000 !important;">
                <div style="width: 80px;">
                    <img src="<?= base_url('img/sma8.jpg') ?>" width="80" height="80" style="object-fit:contain;" onerror="this.style.display='none'">
                </div>
                <div class="text-center flex-grow-1 px-3">
                    <h5 class="fw-bold mb-0">PEMERINTAH DAERAH PROVINSI JAWA BARAT</h5>
                    <h5 class="fw-bold mb-0">DINAS PENDIDIKAN</h5>
                    <h4 class="fw-bold mb-1" style="font-size: 1.4rem;">SMA NEGERI 8 BANDUNG</h4>
                    <p class="mb-0 small" style="font-size: 0.9rem;">
                        Jalan Solontongan No. 3, Lengkong, Kota Bandung, Jawa Barat 40264<br>
                        Telepon: (022) 7304542 &bull; Laman: www.sman8bdg.sch.id
                    </p>
                </div>
                <div style="width: 80px;"></div>
            </div>

            <!-- Title -->
            <div class="text-center mb-4">
                <h4 class="fw-bold text-decoration-underline mb-1">LAPORAN REKAPITULASI PELANGGARAN SISWA</h4>
                <div style="font-size: 1.05rem;">
                    <strong><?= esc($strKelas) ?></strong> &bull; Bulan: <strong><?= esc($bulan) ?></strong> &bull; Tahun: <strong><?= esc($tahun) ?></strong>
                </div>
            </div>

            <!-- Intro text -->
            <p style="font-size: 1rem; line-height: 1.6;">
                Bagian Kedisiplinan SMA Negeri 8 Bandung menyatakan bahwa data di bawah ini merupakan catatan resmi pelanggaran kedisiplinan dan tata tertib siswa yang terhimpun pada sistem:
            </p>

            <!-- Table of records -->
            <div class="table-responsive my-3">
                <table class="table table-bordered align-middle" style="font-size: 10pt; border-color: #000;">
                    <thead>
                        <tr class="table-light text-center" style="font-weight: bold;">
                            <th style="width: 40px;">No</th>
                            <th style="width: 100px;">NIS</th>
                            <th>Nama Siswa</th>
                            <th style="width: 100px;">Tanggal</th>
                            <th>Pelanggaran Yang Dilakukan</th>
                            <th style="width: 80px;">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $totalPoinSemua = 0;
                        if (!empty($row)):
                            foreach ($row as $vaData): 
                                $totalPoinSemua += (int)$vaData['point'];
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= esc($vaData['nis']) ?></td>
                                <td><strong><?= esc($vaData['nama_siswa']) ?></strong></td>
                                <td class="text-center"><?= esc($vaData['tgl_pelanggaran']) ?></td>
                                <td><?= esc($vaData['nama_pelanggaran']) ?></td>
                                <td class="text-center font-monospace fw-bold">+<?= esc($vaData['point']) ?></td>
                            </tr>
                        <?php 
                            endforeach; 
                        else:
                        ?>
                            <tr>
                                <td colspan="6" class="text-center py-3 text-muted">Tidak ada data pelanggaran pada periode / kriteria yang dipilih.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($row)): ?>
                    <tfoot>
                        <tr class="table-light fw-bold">
                            <td colspan="5" class="text-end">Total Poin Keseluruhan:</td>
                            <td class="text-center font-monospace"><?= $totalPoinSemua ?> Poin</td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>

            <p style="font-size: 1rem; line-height: 1.6;" class="mt-4">
                Demikian rekapitulasi data pelanggaran siswa ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.
            </p>

            <!-- Signatures -->
            <div class="row mt-5 pt-3" style="font-size: 1rem;">
                <div class="col-6 text-center">
                    Mengetahui,<br>
                    <strong>Koordinator Bagian Kedisiplinan</strong><br>
                    <br><br><br><br>
                    <u><strong>Tim Disiplin SMAN 8 Bandung</strong></u><br>
                    NIP. 198501012010011001
                </div>
                <div class="col-6 text-center">
                    Bandung, <?= date('d F Y') ?><br>
                    Menyetujui,<br>
                    <strong>Kepala SMA Negeri 8 Bandung</strong><br>
                    <br><br><br>
                    <u><strong>Drs. H. Sukandi, M.Pd.</strong></u><br>
                    NIP. 196512121990031005
                </div>
            </div>

        </div>
    </div>
</div>
