<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Surat Panggilan - <?= esc($nama_siswa ?? 'Siswa') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background: #fff;
            padding: 2cm;
            font-size: 12pt;
            line-height: 1.6;
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
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
    <div class="no-print mb-4 text-end">
        <button onclick="window.print()" class="btn btn-primary btn-sm px-3">
            Cetak Dokumen / Simpan PDF
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
            <div style="font-size: 10pt;">
                Jalan Solontongan No. 3, Lengkong, Kota Bandung, Jawa Barat 40264<br>
                Telepon: (022) 7304542 &bull; Laman: www.sman8bdg.sch.id
            </div>
        </div>
        <div style="width: 80px;"></div>
    </div>

    <!-- Letter Meta -->
    <div class="d-flex justify-content-between mb-4">
        <div>
            <table>
                <tr>
                    <td style="width: 80px;">Nomor</td>
                    <td style="width: 15px;">:</td>
                    <td><?= rand(10, 99) ?>/SMAN.8/BK/<?= date('Y') ?></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td><strong>Panggilan Orang Tua / Wali Murid</strong></td>
                </tr>
            </table>
        </div>
        <div>
            Bandung, <?= date('d F Y') ?>
        </div>
    </div>

    <!-- Kepada -->
    <div class="mb-4">
        Kepada Yth.<br>
        Bapak/Ibu Wali Murid dari:<br>
        <strong><?= esc($nama_siswa ?? '-') ?></strong> (Kelas <?= esc(($kelas ?? '') . ' ' . ($jurusan ?? '') . ' ' . ($no_kelas ?? '')) ?>)<br>
        di Tempat
    </div>

    <!-- Isi -->
    <div style="text-align: justify;" class="mb-4">
        <p>Dengan hormat,</p>
        <p>
            Sehubungan dengan proses pendidikan serta penegakan tata tertib dan disiplin siswa di SMA Negeri 8 Bandung, kami mengharapkan kehadiran Bapak/Ibu/Wali murid ke sekolah untuk berkonsultasi mengenai perkembangan perilaku peserta didik:
        </p>

        <table class="table table-bordered my-3" style="font-size: 11pt;">
            <thead>
                <tr class="table-light">
                    <th>Tanggal</th>
                    <th>Catatan Pelanggaran</th>
                    <th>Sanksi Pembinaan</th>
                    <th>Poin</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($row)): ?>
                    <?php foreach ($row as $vaData): ?>
                        <tr>
                            <td><?= esc($vaData['tgl_pelanggaran']) ?></td>
                            <td><strong><?= esc($vaData['nama_pelanggaran']) ?></strong></td>
                            <td><?= esc($vaData['sanksi_pelanggaran'] ?? '-') ?></td>
                            <td><?= esc($vaData['point']) ?> Poin</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <p>
            Konsultasi dijadwalkan bertempat di Ruang Bimbingan Konseling / Kedisiplinan SMA Negeri 8 Bandung pada jam kerja sekolah.
        </p>
        <p>
            Demikian surat pemanggilan ini kami sampaikan. Atas kerja sama dan kehadiran Bapak/Ibu, kami ucapkan terima kasih.
        </p>
    </div>

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
            Menyetujui,<br>
            <strong>Kepala SMA Negeri 8 Bandung</strong><br>
            <br><br><br><br>
            <u><strong>Drs. H. Sukandi, M.Pd.</strong></u><br>
            NIP. 196512121990031005
        </div>
    </div>

    <script>
        window.onload = function() {
            // Optional auto print
        };
    </script>
</body>
</html>
