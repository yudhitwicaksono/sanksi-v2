<?php 
$randomNo = rand(10, 99);
$nomorSurat = $randomNo . "/SMAN.8/BK/" . date("Y");
$kelasLengkap = trim(($kelas ?? '') . ' ' . ($jurusan ?? '') . ' ' . ($no_kelas ?? ''));
if (empty($kelasLengkap)) $kelasLengkap = '-';
?>

<!-- Dynamic Print & Paper Stylesheet -->
<style id="printPaperStyle">
@page {
    size: A4 portrait;
    margin: 15mm 20mm 15mm 20mm;
}
</style>

<style>
/* Workspace Desk Style for Screen Preview */
.sheet-workspace {
    background-color: #cbd5e1;
    background-image: radial-gradient(#94a3b8 1.2px, transparent 1.2px);
    background-size: 18px 18px;
    padding: 30px 15px;
    border-radius: 14px;
    display: flex;
    justify-content: center;
    overflow-x: auto;
    box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.08);
}

/* Portrait Paper Sheet Base */
.paper-sheet {
    background: #ffffff;
    color: #000000;
    font-family: 'Times New Roman', Times, serif;
    font-size: 11.5pt;
    line-height: 1.5;
    box-sizing: border-box;
    box-shadow: 0 12px 35px rgba(15, 23, 42, 0.2), 0 2px 6px rgba(15, 23, 42, 0.08);
    transition: all 0.25s ease;
    margin: 0 auto;
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

/* Header Kop Garis Ganda */
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

/* Responsive adjustment on narrow mobile screens */
@media screen and (max-width: 890px) {
    .paper-sheet.sheet-a4,
    .paper-sheet.sheet-f4 {
        width: 100%;
        min-height: auto;
        padding: 20px 14px;
    }
}

/* Exact Portrait Print Settings */
@media print {
    /* Hide dashboard layout chrome */
    .app-sidebar,
    .app-navbar,
    footer,
    .no-print,
    .btn,
    .alert,
    #sidebarToggle,
    .sheet-toolbar {
        display: none !important;
    }

    body,
    html,
    .app-layout,
    .app-main,
    .app-content {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        min-height: auto !important;
        box-shadow: none !important;
    }

    .sheet-workspace {
        background: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: block !important;
        overflow: visible !important;
        box-shadow: none !important;
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

<div class="row g-4">
    <!-- Top Action & Setting Bar -->
    <div class="col-12 sheet-toolbar no-print">
        <div class="card-modern shadow-sm border-0 p-3 bg-white">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h4 class="fw-bold mb-1 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-file-contract text-primary"></i>
                        <span>Surat Panggilan Orang Tua / Wali</span>
                    </h4>
                    <div class="d-flex align-items-center gap-2 text-muted small">
                        <span>Format Portrait Resmi SMAN 8 Bandung</span>
                        <span>&bull;</span>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle" id="paperSizeBadge">
                            Ukuran Kertas: A4 (210 × 297 mm)
                        </span>
                    </div>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2">
                    <!-- Paper Size Toggle -->
                    <div class="btn-group shadow-sm" role="group" aria-label="Pilih Ukuran Kertas">
                        <button type="button" class="btn btn-primary btn-sm px-3 fw-semibold active" id="btnPaperA4" onclick="setPaperSize('a4')">
                            <i class="fa-regular fa-file-lines me-1"></i> A4 (210 × 297 mm)
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm px-3 fw-semibold" id="btnPaperF4" onclick="setPaperSize('f4')">
                            <i class="fa-regular fa-file-lines me-1"></i> F4 / Folio (215 × 330 mm)
                        </button>
                    </div>

                    <!-- Print / PDF Action -->
                    <button type="button" class="btn btn-danger btn-sm px-3 shadow-sm" onclick="window.print()">
                        <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
                    </button>

                    <!-- Open Standalone Print Tab -->
                    <a href="<?= site_url('main/viewPrintSurat/' . ($id_wali ?? '') . '/' . ($nis ?? '')) ?>" 
                       target="_blank" 
                       id="btnViewPrintSurat"
                       data-base-url="<?= site_url('main/viewPrintSurat/' . ($id_wali ?? '') . '/' . ($nis ?? '')) ?>"
                       class="btn btn-outline-danger btn-sm px-3" 
                       title="Buka tampilan cetak penuh di tab baru">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Tab Cetak
                    </a>

                    <!-- Back Button -->
                    <a href="<?= site_url('main/surat_penggilan_orang_tua') ?>" class="btn btn-outline-secondary btn-sm px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Letter Preview Workspace -->
    <div class="col-12">
        <div class="sheet-workspace">
            <!-- Sheet Card in Portrait -->
            <div class="paper-sheet sheet-a4" id="paperSheet">
                
                <!-- Kop Surat -->
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
                        Sehubungan dengan hasil pembinaan kedisiplinan dan tata tertib peserta didik di lingkungan SMA Negeri 8 Bandung, kami mengundang Bapak/Ibu/Wali murid untuk hadir ke sekolah guna berkonsultasi mengenai proses pembinaan peserta didik atas nama <strong><?= esc($nama_siswa ?? '-') ?></strong>, yang tercatat melakukan pelanggaran tata tertib sekolah sebagai berikut:
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
        </div>
    </div>
</div>

<!-- Interactive Paper Switcher Script -->
<script>
function setPaperSize(size) {
    const sheet = document.getElementById('paperSheet');
    const styleEl = document.getElementById('printPaperStyle');
    const btnA4 = document.getElementById('btnPaperA4');
    const btnF4 = document.getElementById('btnPaperF4');
    const badge = document.getElementById('paperSizeBadge');
    const printLink = document.getElementById('btnViewPrintSurat');

    if (size === 'f4') {
        sheet.classList.remove('sheet-a4');
        sheet.classList.add('sheet-f4');

        btnA4.classList.remove('active', 'btn-primary');
        btnA4.classList.add('btn-outline-primary');

        btnF4.classList.add('active', 'btn-primary');
        btnF4.classList.remove('btn-outline-primary');

        badge.textContent = 'Ukuran Kertas: F4 / Folio (215 × 330 mm)';
        badge.className = 'badge bg-success-subtle text-success border border-success-subtle';

        styleEl.innerHTML = '@page { size: 215mm 330mm portrait; margin: 15mm 20mm 15mm 20mm; }';

        if (printLink) {
            const baseUrl = printLink.getAttribute('data-base-url');
            printLink.href = baseUrl + '?paper=f4';
        }
    } else {
        sheet.classList.remove('sheet-f4');
        sheet.classList.add('sheet-a4');

        btnF4.classList.remove('active', 'btn-primary');
        btnF4.classList.add('btn-outline-primary');

        btnA4.classList.add('active', 'btn-primary');
        btnA4.classList.remove('btn-outline-primary');

        badge.textContent = 'Ukuran Kertas: A4 (210 × 297 mm)';
        badge.className = 'badge bg-primary-subtle text-primary border border-primary-subtle';

        styleEl.innerHTML = '@page { size: A4 portrait; margin: 15mm 20mm 15mm 20mm; }';

        if (printLink) {
            const baseUrl = printLink.getAttribute('data-base-url');
            printLink.href = baseUrl + '?paper=a4';
        }
    }
}
</script>
