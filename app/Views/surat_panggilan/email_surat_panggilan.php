<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panggilan Orang Tua / Wali Murid <?= esc($nama_siswa ?? '') ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 680px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            background-color: #ffffff;
            padding: 24px 30px 16px;
            border-bottom: 3px double #334155;
            text-align: center;
        }
        .header-title {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header-subtitle {
            font-size: 18px;
            font-weight: 800;
            color: #b91c1c;
            margin: 4px 0 0;
            letter-spacing: 1px;
        }
        .header-address {
            font-size: 11px;
            color: #64748b;
            margin: 4px 0 0;
        }
        .email-body {
            padding: 30px;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 13.5px;
        }
        .meta-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .table-pelanggaran {
            width: 100%;
            border-collapse: collapse;
            margin: 18px 0;
            font-size: 13px;
        }
        .table-pelanggaran th {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
            padding: 9px 12px;
            text-align: left;
            font-weight: bold;
        }
        .table-pelanggaran td {
            border: 1px solid #cbd5e1;
            padding: 9px 12px;
            color: #1e293b;
        }
        .table-jadwal {
            width: 100%;
            margin: 12px 0 20px;
            font-size: 13.5px;
            background-color: #f8fafc;
            border-left: 4px solid #ef4444;
            padding: 12px 16px;
            border-radius: 4px;
        }
        .table-jadwal td {
            padding: 4px 0;
            vertical-align: top;
        }
        .signature-section {
            margin-top: 36px;
            width: 100%;
        }
        .signature-box {
            text-align: center;
            font-size: 13px;
        }
        .email-footer {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 16px 30px;
            text-align: center;
            font-size: 11.5px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header / Kop Surat -->
        <div class="email-header">
            <div class="header-title">Pemerintah Daerah Provinsi Jawa Barat - Dinas Pendidikan</div>
            <div class="header-subtitle">SMA NEGERI 8 BANDUNG</div>
            <div class="header-address">Jl. Solontongan No. 3, Turangga, Kec. Lengkong, Kota Bandung, Jawa Barat 40264</div>
        </div>

        <!-- Body Surat -->
        <div class="email-body">
            <!-- Informasi Penerima -->
            <table class="meta-table" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width: 110px;">Nomor</td>
                    <td style="width: 15px;">:</td>
                    <td>421.3 / SP-BK / <?= date('Y') ?></td>
                    <td style="text-align: right; color: #64748b;">Bandung, <?= date('d/m/Y') ?></td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td colspan="2"><strong>Panggilan Orang Tua / Wali Murid</strong></td>
                </tr>
                <tr>
                    <td>Kepada Yth.</td>
                    <td>:</td>
                    <td colspan="2">Bapak/Ibu/Wali dari <strong><?= esc($nama_siswa ?? '-') ?></strong></td>
                </tr>
                <tr>
                    <td>Alamat / Email</td>
                    <td>:</td>
                    <td colspan="2"><?= esc($nama_wali ?? '-') ?> (<?= esc($email_wali ?? '-') ?>)</td>
                </tr>
            </table>

            <p style="margin-top: 20px;">Dengan hormat,</p>

            <p style="text-align: justify;">
                Sehubungan dengan hasil pembinaan kedisiplinan dan tata tertib peserta didik di lingkungan SMA Negeri 8 Bandung, kami mengundang Bapak/Ibu/Wali murid untuk hadir ke sekolah guna berkonsultasi mengenai proses pembinaan peserta didik atas nama <strong><?= esc($nama_siswa ?? '-') ?></strong>, yang tercatat melakukan pelanggaran tata tertib sekolah sebagai berikut:
            </p>

            <!-- Tabel Pelanggaran -->
            <table class="table-pelanggaran" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 25%;">Tanggal Kejadian</th>
                        <th style="width: 35%;">Jenis Pelanggaran</th>
                        <th style="width: 15%; text-align: center;">Poin</th>
                        <th style="width: 25%;">Tindakan / Sanksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($row)): ?>
                        <?php foreach ($row as $vaData): ?>
                            <tr>
                                <td><?= esc($vaData['tgl_pelanggaran']) ?></td>
                                <td><strong><?= esc($vaData['nama_pelanggaran']) ?></strong></td>
                                <td style="text-align: center; font-weight: bold; color: #dc2626;">
                                    <?= esc($vaData['point'] ?? '-') ?> Poin
                                </td>
                                <td><?= esc($vaData['sanksi_pelanggaran'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #64748b;">Data akumulasi pelanggaran telah mencapai 10 poin atau lebih.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <p>
                Adapun konsultasi pemanggilan orang tua / wali murid dijadwalkan dapat dilaksanakan pada:
            </p>

            <!-- Jadwal Pemanggilan -->
            <table class="table-jadwal" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width: 140px; font-weight: bold; color: #334155;">Hari / Waktu</td>
                    <td style="width: 15px; font-weight: bold;">:</td>
                    <td><strong>Jam Kerja Sekolah (08.00 - 14.00 WIB)</strong></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; color: #334155;">Tempat</td>
                    <td style="font-weight: bold;">:</td>
                    <td>Ruang Bimbingan Konseling (BK) / Bagian Kedisiplinan SMAN 8 Bandung</td>
                </tr>
            </table>

            <p style="text-align: justify; margin-bottom: 30px;">
                Demikian surat pemanggilan ini kami sampaikan. Mengingat pentingnya perihal tersebut demi kelancaran proses pendidikan dan masa depan putra/putri Bapak/Ibu, atas perhatian, kerja sama, dan kehadirannya kami ucapkan terima kasih.
            </p>

            <!-- Berkas Softfile Surat Panggilan (.PDF) -->
            <div style="margin-top: 30px; padding: 18px 20px; background-color: #fef2f2; border: 1.5px dashed #ef4444; border-radius: 8px;">
                <table cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tr>
                        <td style="width: 52px; vertical-align: middle; text-align: center;">
                            <div style="width: 46px; height: 46px; line-height: 46px; background-color: #dc2626; color: #ffffff; border-radius: 8px; font-weight: bold; font-size: 15px; text-align: center; display: inline-block; box-shadow: 0 2px 4px rgba(220, 38, 38, 0.25);">
                                PDF
                            </div>
                        </td>
                        <td style="padding-left: 14px; vertical-align: middle;">
                            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #991b1b; font-weight: bold;">
                                Berkas Softfile Terlampir
                            </div>
                            <div style="font-size: 14px; font-weight: bold; color: #0f172a; margin-top: 2px;">
                                <?= esc($pdf_filename ?? ('Surat_Panggilan_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $nama_siswa ?? 'Siswa') . '_' . ($nis ?? '') . '.pdf')) ?>
                            </div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 3px;">
                                Dokumen resmi dengan kop surat, nomor surat, dan pengesahan Kepala Sekolah telah dilampirkan pada email ini dalam format .PDF.
                            </div>
                        </td>
                        <?php if (!empty($pdf_download_url)): ?>
                        <td style="text-align: right; vertical-align: middle; width: 140px;">
                            <a href="<?= esc($pdf_download_url) ?>" 
                               target="_blank" 
                               style="display: inline-block; padding: 9px 16px; background-color: #dc2626; color: #ffffff; text-decoration: none; font-size: 12px; font-weight: bold; border-radius: 6px; box-shadow: 0 2px 4px rgba(220, 38, 38, 0.2);">
                                Unduh .PDF
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            Surat ini diterbitkan secara otomatis oleh Sistem Informasi Kedisiplinan Siswa SMAN 8 Bandung.<br>
            Pengirim: <?= esc($from_name ?? 'Admin') ?> (<?= esc($from_email ?? 'admin@gmail.com') ?>)
        </div>
    </div>
</body>
</html>
