<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pelanggaran Siswa - SMAN 8 Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background: #fff;
            padding: 1.5cm;
            font-size: 11pt;
            line-height: 1.5;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
        }
        .header-kop {
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="no-print mb-4 text-end">
        <button onclick="window.print()" class="btn btn-primary btn-sm px-3">
            Cetak Laporan / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm px-3">
            Tutup
        </button>
    </div>

    <!-- Kop Surat -->
    <div class="header-kop d-flex align-items-center justify-content-between">
        <div style="width: 80px;">
            <img src="<?= base_url('img/sma8.jpg') ?>" width="80" height="80" style="object-fit:contain;" onerror="this.style.display='none'">
        </div>
        <div class="text-center flex-grow-1 px-3">
            <h5 class="fw-bold mb-0">PEMERINTAH DAERAH PROVINSI JAWA BARAT</h5>
            <h5 class="fw-bold mb-0">DINAS PENDIDIKAN</h5>
            <h4 class="fw-bold mb-1">SMA NEGERI 8 BANDUNG</h4>
            <div style="font-size: 9pt;">
                Jalan Solontongan No. 3, Lengkong, Kota Bandung, Jawa Barat 40264<br>
                Telepon: (022) 7304542 &bull; Laman: www.sman8bdg.sch.id
            </div>
        </div>
        <div style="width: 80px;"></div>
    </div>

    <?php 
    $strKelas = "Semua Kelas";
    if ($id_kelas !== 'semua-kelas' && !empty($kelas)) {
        foreach ($kelas as $k) {
            $strKelas = "Kelas " . $k['kelas'] . " " . $k['jurusan'] . " " . $k['no_kelas'];
        }
    }
    ?>

    <!-- Judul -->
    <div class="text-center mb-4">
        <h5 class="fw-bold text-decoration-underline mb-1">LAPORAN REKAPITULASI PELANGGARAN SISWA</h5>
        <div>
            <strong><?= esc($strKelas) ?></strong> &bull; Bulan: <strong><?= esc($bulan) ?></strong> &bull; Tahun: <strong><?= esc($tahun) ?></strong>
        </div>
    </div>

    <p>
        Bagian Kedisiplinan SMA Negeri 8 Bandung menyatakan bahwa data di bawah ini merupakan catatan resmi pelanggaran kedisiplinan dan tata tertib siswa:
    </p>

    <!-- Tabel Data -->
    <table class="table table-bordered align-middle my-3" style="font-size: 10pt; border-color: #000;">
        <thead>
            <tr class="table-light text-center fw-bold">
                <th style="width: 40px;">No</th>
                <th style="width: 100px;">NIS</th>
                <th>Nama Siswa</th>
                <th style="width: 100px;">Tanggal</th>
                <th>Pelanggaran</th>
                <th style="width: 70px;">Poin</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $totalPoin = 0;
            if (!empty($row)):
                foreach ($row as $vaData): 
                    $totalPoin += (int)$vaData['point'];
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= esc($vaData['nis']) ?></td>
                    <td><strong><?= esc($vaData['nama_siswa']) ?></strong></td>
                    <td class="text-center"><?= esc($vaData['tgl_pelanggaran']) ?></td>
                    <td><?= esc($vaData['nama_pelanggaran']) ?></td>
                    <td class="text-center fw-bold">+<?= esc($vaData['point']) ?></td>
                </tr>
            <?php 
                endforeach; 
            else:
            ?>
                <tr>
                    <td colspan="6" class="text-center py-3">Tidak ada data pelanggaran pada periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <?php if (!empty($row)): ?>
        <tfoot>
            <tr class="table-light fw-bold">
                <td colspan="5" class="text-end">Total Poin Keseluruhan:</td>
                <td class="text-center"><?= $totalPoin ?> Poin</td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>

    <p class="mt-4">
        Demikian rekapitulasi data pelanggaran siswa ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.
    </p>

    <!-- Tanda Tangan -->
    <div class="d-flex justify-content-between mt-5 pt-3">
        <div class="text-center" style="width: 40%;">
            Mengetahui,<br>
            <strong>Koordinator Bagian Kedisiplinan</strong><br>
            <br><br><br><br>
            <u><strong>Tim Disiplin SMAN 8 Bandung</strong></u><br>
            NIP. 198501012010011001
        </div>
        <div class="text-center" style="width: 40%;">
            Bandung, <?= date('d F Y') ?><br>
            Menyetujui,<br>
            <strong>Kepala SMA Negeri 8 Bandung</strong><br>
            <br><br><br><br>
            <u><strong>Drs. H. Sukandi, M.Pd.</strong></u><br>
            NIP. 196512121990031005
        </div>
    </div>
</body>
</html>
