<?php 
$randomNo = rand(10, 99);
$nomorSurat = $randomNo . "/SMAN.8/BK/" . date("Y");
?>
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1"><i class="fa-solid fa-file-contract text-primary me-2"></i>Pratinjau Surat Panggilan Orang Tua</h4>
            <p class="text-muted small mb-0">Format resmi surat pemanggilan orang tua / wali murid SMAN 8 Bandung</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= site_url('main/data_wali_muridP') ?>" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
            <a href="<?= site_url('main/viewPrintSurat/' . ($id_wali ?? '') . '/' . ($nis ?? '')) ?>" target="_blank" class="btn btn-danger">
                <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
            </a>
        </div>
    </div>

    <!-- Letter Preview Sheet -->
    <div class="col-12 col-xl-10 mx-auto">
        <div class="card-modern shadow-lg p-5 bg-white" style="border: 2px solid #e2e8f0; font-family: 'Times New Roman', Times, serif;">
            
            <!-- Kop Surat -->
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4" style="border-bottom: 3px double #000 !important;">
                <div style="width: 90px; text-align: center;">
                    <img src="<?= base_url('img/sma8.jpg') ?>" width="80" height="80" style="object-fit:contain;" onerror="this.style.display='none'">
                </div>
                <div class="text-center flex-grow-1 px-3">
                    <h5 class="fw-bold mb-0" style="letter-spacing: 1px;">PEMERINTAH DAERAH PROVINSI JAWA BARAT</h5>
                    <h5 class="fw-bold mb-0">DINAS PENDIDIKAN</h5>
                    <h4 class="fw-bold mb-1" style="font-size: 1.4rem;">SMA NEGERI 8 BANDUNG</h4>
                    <p class="mb-0 small" style="font-size: 0.9rem;">
                        Jalan Solontongan No. 3, Lengkong, Kota Bandung, Jawa Barat 40264<br>
                        Telepon: (022) 7304542 &bull; Laman: www.sman8bdg.sch.id
                    </p>
                </div>
                <div style="width: 90px;"></div>
            </div>

            <!-- Letter Meta -->
            <div class="row mb-4" style="font-size: 1rem; line-height: 1.6;">
                <div class="col-7">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 90px;">Nomor</td>
                            <td style="width: 15px;">:</td>
                            <td><strong><?= esc($nomorSurat) ?></strong></td>
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
                <div class="col-5 text-end">
                    Bandung, <?= date('d F Y') ?>
                </div>
            </div>

            <!-- Recipient -->
            <div class="mb-4" style="font-size: 1rem; line-height: 1.6;">
                Kepada Yth.<br>
                <strong>Bapak / Ibu Wali Murid dari:</strong><br>
                Nama Siswa: <strong><?= esc($nama_siswa ?? '-') ?></strong><br>
                Kelas: <strong><?= esc(($kelas ?? '') . ' ' . ($jurusan ?? '') . ' ' . ($no_kelas ?? '')) ?></strong><br>
                di Tempat
            </div>

            <!-- Content -->
            <div class="mb-4" style="font-size: 1rem; line-height: 1.8; text-align: justify;">
                <p>Dengan hormat,</p>
                <p>
                    Sehubungan dengan hasil evaluasi kedisiplinan dan tata tertib siswa di lingkungan SMA Negeri 8 Bandung, kami mengundang Bapak/Ibu/Wali murid untuk hadir guna berkonsultasi mengenai proses pembinaan peserta didik atas nama <strong><?= esc($nama_siswa ?? '') ?></strong>, yang telah tercatat melakukan pelanggaran tata tertib sekolah sebagai berikut:
                </p>

                <div class="p-3 my-3 bg-light rounded-2 border">
                    <table style="width: 100%; font-size: 0.95rem;">
                        <?php if (!empty($row)): ?>
                            <?php foreach ($row as $vaData): ?>
                                <tr>
                                    <td style="width: 160px; font-weight: bold;">Jenis Pelanggaran</td>
                                    <td style="width: 15px;">:</td>
                                    <td><?= esc($vaData['nama_pelanggaran']) ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Tanggal Kejadian</td>
                                    <td>:</td>
                                    <td><?= esc($vaData['tgl_pelanggaran']) ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Tindakan / Sanksi</td>
                                    <td>:</td>
                                    <td><?= esc($vaData['sanksi_pelanggaran'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            <td style="font-weight: bold;">Tempat Konsultasi</td>
                            <td>:</td>
                            <td>Ruang Bagian Kedisiplinan / Bimbingan Konseling SMAN 8 Bandung</td>
                        </tr>
                    </table>
                </div>

                <p>
                    Demikian surat pemanggilan ini kami sampaikan. Mengingat pentingnya perihal ini demi masa depan dan kelancaran pendidikan putra/putri Bapak/Ibu, atas perhatian dan kehadirannya kami ucapkan terima kasih.
                </p>
            </div>

            <!-- Signatures -->
            <div class="row mt-5 pt-4" style="font-size: 1rem;">
                <div class="col-6 text-center">
                    Mengetahui,<br>
                    <strong>Koordinator Bagian Kedisiplinan</strong><br>
                    <br><br><br>
                    <u><strong>Tim Disiplin SMAN 8 Bandung</strong></u><br>
                    NIP. 198501012010011001
                </div>
                <div class="col-6 text-center">
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
