<?php 
$randomNo = rand(10, 99);
$nomorSurat = $randomNo . "/SMAN.8/BK/" . date("Y");
$kelasLengkap = trim(($kelas ?? '') . ' ' . ($jurusan ?? '') . ' ' . ($no_kelas ?? ''));
if (empty($kelasLengkap)) $kelasLengkap = '-';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Panggilan Orang Tua - <?= esc($nama_siswa ?? 'Siswa') ?></title>
    
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Dynamic Print & Page Size Stylesheet -->
    <style id="printPageStyle">
        @page {
            size: A4 portrait;
            margin: 15mm 20mm 15mm 20mm;
        }
    </style>

    <style>
        /* Screen Workspace Styling */
        body {
            background-color: #cbd5e1;
            background-image: radial-gradient(#94a3b8 1.2px, transparent 1.2px);
            background-size: 18px 18px;
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
            color: #000000;
            min-height: 100vh;
        }

        /* Top Bar Controls */
        .print-topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 10px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .paper-desk {
            display: flex;
            justify-content: center;
            padding: 30px 15px 50px 15px;
            overflow-x: auto;
        }

        /* Paper Sheet Layout */
        .paper-sheet {
            background: #ffffff;
            box-sizing: border-box;
            box-shadow: 0 12px 35px rgba(15, 23, 42, 0.2), 0 2px 6px rgba(15, 23, 42, 0.08);
            color: #000000;
            font-size: 11.5pt;
            line-height: 1.5;
            transition: all 0.25s ease;
            position: relative;
        }

        /* A4 Portrait: 210mm x 297mm */
        .paper-sheet.sheet-a4 {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm 20mm 20mm 20mm;
        }

        /* F4 / Folio Portrait: 215mm x 330mm */
        .paper-sheet.sheet-f4 {
            width: 215mm;
            min-height: 330mm;
            padding: 20mm 20mm 20mm 20mm;
        }

        /* Kop Surat Garis Ganda */
        .kop-surat-header {
            border-bottom: 3px double #000000 !important;
            padding-bottom: 12px;
            margin-bottom: 22px;
        }

        .kop-logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
        }

        /* Detail Tabel Pelanggaran */
        .table-pelanggaran-surat {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 14px;
            font-size: 10.5pt;
        }
        .table-pelanggaran-surat th, 
        .table-pelanggaran-surat td {
            border: 1px solid #000;
            padding: 6px 10px;
        }
        .table-pelanggaran-surat th {
            background-color: #f1f5f9;
            text-align: center;
            font-weight: bold;
        }

        /* Mobile preview adjustment */
        @media screen and (max-width: 890px) {
            .paper-sheet.sheet-a4,
            .paper-sheet.sheet-f4 {
                width: 100%;
                min-height: auto;
                padding: 20px 14px;
            }
        }

        /* Exact Portrait Print Styles */
        @media print {
            .no-print,
            .print-topbar {
                display: none !important;
            }

            body,
            html {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            .paper-desk {
                padding: 0 !important;
                margin: 0 !important;
                display: block !important;
                overflow: visible !important;
            }

            .paper-sheet {
                width: 100% !important;
                min-height: auto !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border: none !important;
                font-size: 11pt !important;
                line-height: 1.4 !important;
                page-break-after: avoid !important;
                page-break-inside: avoid !important;
            }

            .table-pelanggaran-surat th {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>

    <!-- Printable Control Toolbar -->
    <header class="print-topbar no-print">
        <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-dark fs-6">
                    <i class="fa-solid fa-file-contract text-primary me-2"></i>Cetak Surat Panggilan
                </span>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle" id="badgePaper">
                    Ukuran: A4 Portrait
                </span>
            </div>

            <!-- Paper Size Selector & Action Buttons -->
            <div class="d-flex align-items-center gap-2">
                <div class="btn-group" role="group" aria-label="Ukuran Kertas">
                    <button type="button" class="btn btn-sm btn-primary active px-3 fw-semibold" id="btnA4" onclick="applyPaper('a4')">
                        <i class="fa-regular fa-file-lines me-1"></i> A4 (210 × 297 mm)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary px-3 fw-semibold" id="btnF4" onclick="applyPaper('f4')">
                        <i class="fa-regular fa-file-lines me-1"></i> F4 / Folio (215 × 330 mm)
                    </button>
                </div>

                <button type="button" class="btn btn-sm btn-danger px-3 shadow-sm" onclick="window.print()">
                    <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary px-3" onclick="window.close()">
                    <i class="fa-solid fa-xmark me-1"></i> Tutup
                </button>
            </div>
        </div>
    </header>

    <!-- Workspace Preview -->
    <main class="paper-desk">
        <div class="paper-sheet sheet-a4" id="paperSheet">
            
            <!-- Kop Surat Resmi -->
            <div class="kop-surat-header d-flex align-items-center justify-content-between">
                <div style="width: 90px; text-align: center;">
                    <img src="<?= base_url('img/sma8.jpg') ?>" class="kop-logo" alt="Logo SMAN 8 Bandung" onerror="this.style.display='none'">
                </div>
                <div class="text-center flex-grow-1 px-3">
                    <h5 class="fw-bold mb-0" style="font-size: 1.05rem; letter-spacing: 0.5px;">PEMERINTAH DAERAH PROVINSI JAWA BARAT</h5>
                    <h5 class="fw-bold mb-0" style="font-size: 1.05rem; letter-spacing: 0.5px;">DINAS PENDIDIKAN</h5>
                    <h3 class="fw-bold mb-1" style="font-size: 1.35rem; letter-spacing: 1px;">SMA NEGERI 8 BANDUNG</h3>
                    <p class="mb-0" style="font-size: 9pt; line-height: 1.35;">
                        Jalan Solontongan No. 3, Lengkong, Kota Bandung, Jawa Barat 40264<br>
                        Telepon: (022) 7304542 &bull; Laman: www.sman8bdg.sch.id &bull; Pos-el: info@sman8bdg.sch.id
                    </p>
                </div>
                <div style="width: 90px;"></div>
            </div>

            <!-- Letter Meta (Nomor, Lampiran, Perihal & Tanggal) -->
            <div class="d-flex justify-content-between align-items-start mb-3" style="font-size: 11pt;">
                <div>
                    <table style="border: none;">
                        <tr>
                            <td style="width: 85px; padding-bottom: 2px;">Nomor</td>
                            <td style="width: 15px; padding-bottom: 2px;">:</td>
                            <td style="padding-bottom: 2px;"><strong><?= esc($nomorSurat) ?></strong></td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 2px;">Lampiran</td>
                            <td style="padding-bottom: 2px;">:</td>
                            <td style="padding-bottom: 2px;">-</td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 2px;">Perihal</td>
                            <td style="padding-bottom: 2px;">:</td>
                            <td style="padding-bottom: 2px;"><strong>Panggilan Orang Tua / Wali Murid</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="text-end">
                    Bandung, <?= date('d F Y') ?>
                </div>
            </div>

            <!-- Recipient Info -->
            <div class="mb-3" style="font-size: 11pt; line-height: 1.45;">
                Kepada Yth.<br>
                <strong>Bapak / Ibu Wali Murid dari:</strong><br>
                <table style="border: none; margin-top: 4px; margin-left: 15px;">
                    <tr>
                        <td style="width: 110px;">Nama Siswa</td>
                        <td style="width: 15px;">:</td>
                        <td><strong><?= esc($nama_siswa ?? '-') ?></strong></td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td><?= esc($nis ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?= esc($kelasLengkap) ?></td>
                    </tr>
                </table>
                <div class="mt-1">di Tempat</div>
            </div>

            <!-- Content Body -->
            <div class="mb-3" style="font-size: 11pt; line-height: 1.5; text-align: justify;">
                <p class="mb-2">Dengan hormat,</p>
                <p class="mb-2">
                    Sehubungan dengan hasil pembinaan kedisiplinan dan penegakan tata tertib peserta didik di lingkungan SMA Negeri 8 Bandung, kami mengundang Bapak/Ibu/Wali murid untuk hadir ke sekolah guna berkonsultasi mengenai proses pembinaan peserta didik atas nama <strong><?= esc($nama_siswa ?? '-') ?></strong>, yang tercatat melakukan pelanggaran tata tertib sekolah sebagai berikut:
                </p>

                <!-- Violations Table -->
                <table class="table-pelanggaran-surat">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Tanggal Kejadian</th>
                            <th style="width: 35%;">Jenis Pelanggaran</th>
                            <th style="width: 15%;">Poin</th>
                            <th style="width: 25%;">Tindakan / Sanksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($row)): ?>
                            <?php foreach ($row as $vaData): ?>
                                <tr>
                                    <td class="text-center"><?= esc($vaData['tgl_pelanggaran']) ?></td>
                                    <td><strong><?= esc($vaData['nama_pelanggaran']) ?></strong></td>
                                    <td class="text-center"><span class="fw-bold"><?= esc($vaData['point'] ?? '-') ?></span> Poin</td>
                                    <td><?= esc($vaData['sanksi_pelanggaran'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Data pelanggaran telah melampaui batas toleransi poin disiplin.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <p class="mb-2">
                    Adapun konsultasi pemanggilan orang tua / wali murid dijadwalkan dapat dilaksanakan pada:
                </p>
                <div style="margin-left: 20px;" class="mb-3">
                    <table style="border: none;">
                        <tr>
                            <td style="width: 140px; padding: 2px 0;">Hari / Waktu</td>
                            <td style="width: 15px; padding: 2px 0;">:</td>
                            <td style="padding: 2px 0;">Jam Kerja Sekolah (08.00 - 14.00 WIB)</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Tempat</td>
                            <td style="padding: 2px 0;">:</td>
                            <td style="padding: 2px 0;">Ruang Bimbingan Konseling (BK) / Bagian Kedisiplinan SMAN 8 Bandung</td>
                        </tr>
                    </table>
                </div>

                <p class="mb-0">
                    Demikian surat pemanggilan ini kami sampaikan. Mengingat pentingnya perihal tersebut demi kelancaran proses pendidikan dan masa depan putra/putri Bapak/Ibu, atas perhatian, kerja sama, dan kehadirannya kami ucapkan terima kasih.
                </p>
            </div>

            <!-- Signatures -->
            <div class="row pt-4" style="page-break-inside: avoid; font-size: 11pt;">
                <div class="col-6 text-center">
                    Mengetahui,<br>
                    <strong>Koordinator Bagian Kedisiplinan</strong><br>
                    <br><br><br><br>
                    <u><strong>Tim Disiplin SMAN 8 Bandung</strong></u><br>
                    <span>NIP. 198501012010011001</span>
                </div>
                <div class="col-6 text-center">
                    Menyetujui,<br>
                    <strong>Kepala SMA Negeri 8 Bandung</strong><br>
                    <br><br><br><br>
                    <u><strong>Drs. H. Sukandi, M.Pd.</strong></u><br>
                    <span>NIP. 196512121990031005</span>
                </div>
            </div>

        </div>
    </main>

    <!-- JavaScript for Paper Sizing and Auto-detection -->
    <script>
        function applyPaper(size) {
            const sheet = document.getElementById('paperSheet');
            const styleEl = document.getElementById('printPageStyle');
            const btnA4 = document.getElementById('btnA4');
            const btnF4 = document.getElementById('btnF4');
            const badge = document.getElementById('badgePaper');

            if (size === 'f4') {
                sheet.classList.remove('sheet-a4');
                sheet.classList.add('sheet-f4');

                btnA4.classList.remove('active', 'btn-primary');
                btnA4.classList.add('btn-outline-primary');

                btnF4.classList.add('active', 'btn-primary');
                btnF4.classList.remove('btn-outline-primary');

                badge.textContent = 'Ukuran: F4 / Folio Portrait (215 × 330 mm)';
                badge.className = 'badge bg-success-subtle text-success border border-success-subtle';

                styleEl.innerHTML = '@page { size: 215mm 330mm portrait; margin: 15mm 20mm 15mm 20mm; }';
            } else {
                sheet.classList.remove('sheet-f4');
                sheet.classList.add('sheet-a4');

                btnF4.classList.remove('active', 'btn-primary');
                btnF4.classList.add('btn-outline-primary');

                btnA4.classList.add('active', 'btn-primary');
                btnA4.classList.remove('btn-outline-primary');

                badge.textContent = 'Ukuran: A4 Portrait (210 × 297 mm)';
                badge.className = 'badge bg-primary-subtle text-primary border border-primary-subtle';

                styleEl.innerHTML = '@page { size: A4 portrait; margin: 15mm 20mm 15mm 20mm; }';
            }
        }

        // Check URL parameter (e.g. ?paper=f4)
        window.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const paperParam = params.get('paper');
            if (paperParam === 'f4') {
                applyPaper('f4');
            } else {
                applyPaper('a4');
            }
        });
    </script>
</body>
</html>
