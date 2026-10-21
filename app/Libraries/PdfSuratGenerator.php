<?php

namespace App\Libraries;

/**
 * Class PdfSuratGenerator
 * 
 * Generator PDF Surat Panggilan resmi SMAN 8 Bandung murni berbasis PHP
 * tanpa dependensi eksternal (standar PDF 1.4, kompatibel dengan semua PDF Reader).
 */
class PdfSuratGenerator
{
    protected float $pageWidth = 595.28;   // A4 Width in points
    protected float $pageHeight = 841.89;  // A4 Height in points
    protected float $marginLeft = 50.0;
    protected float $marginRight = 50.0;
    protected float $marginTop = 50.0;
    protected float $currentY = 790.0;
    protected string $stream = '';

    /**
     * Escape special PDF string characters
     */
    protected function escapePdfString(string $text): string
    {
        $text = str_replace('\\', '\\\\', $text);
        $text = str_replace('(', '\\(', $text);
        $text = str_replace(')', '\\)', $text);
        $text = str_replace("\r", '', $text);
        return $text;
    }

    /**
     * Add text at specific coordinate
     */
    protected function text(float $x, float $y, string $text, string $font = 'F1', float $size = 11.0): void
    {
        $escaped = $this->escapePdfString($text);
        $this->stream .= sprintf("BT /%s %.2f Tf %.2f %.2f Td (%s) Tj ET\n", $font, $size, $x, $y, $escaped);
    }

    /**
     * Draw horizontal line
     */
    protected function line(float $x1, float $y1, float $x2, float $y2, float $width = 1.0): void
    {
        $this->stream .= sprintf("%.2f w %.2f %.2f m %.2f %.2f l s\n", $width, $x1, $y1, $x2, $y2);
    }

    /**
     * Draw rectangle
     */
    protected function rect(float $x, float $y, float $w, float $h, string $op = 's', float $lineWidth = 1.0): void
    {
        $this->stream .= sprintf("%.2f w %.2f %.2f %.2f %.2f re %s\n", $lineWidth, $x, $y, $w, $h, $op);
    }

    /**
     * Wrap and render text block
     */
    protected function paragraph(float $x, float &$y, string $text, float $maxWidth, string $font = 'F1', float $size = 11.0, float $lineHeight = 15.0): void
    {
        $words = explode(' ', $text);
        $currentLine = '';
        $charLimit = (int)($maxWidth / ($size * 0.45)); // perkiraan batas karakter per baris

        foreach ($words as $word) {
            $testLine = $currentLine === '' ? $word : $currentLine . ' ' . $word;
            if (strlen($testLine) > $charLimit) {
                $this->text($x, $y, $currentLine, $font, $size);
                $y -= $lineHeight;
                $currentLine = $word;
            } else {
                $currentLine = $testLine;
            }
        }
        if ($currentLine !== '') {
            $this->text($x, $y, $currentLine, $font, $size);
            $y -= $lineHeight;
        }
    }

    /**
     * Generate PDF binary content
     */
    public function generate(array $data, ?string $outputPath = null): string
    {
        $this->stream = '';
        $namaSiswa = $data['nama_siswa'] ?? 'Siswa';
        $nis = $data['nis'] ?? '-';
        $kelas = $data['kelas'] ?? '-';
        $namaWali = $data['nama_wali'] ?? '-';
        $alamatWali = $data['alamat_wali'] ?? '-';
        $emailWali = $data['email_wali'] ?? '-';
        $fromName = $data['from_name'] ?? 'Tim Disiplin SMAN 8 Bandung';
        $pelanggaran = $data['row'] ?? [];

        $usableWidth = $this->pageWidth - $this->marginLeft - $this->marginRight;
        $contentLeft = $this->marginLeft;
        $y = $this->pageHeight - $this->marginTop;

        // 1. KOP SURAT
        $this->text($contentLeft + 50, $y, 'PEMERINTAH DAERAH PROVINSI JAWA BARAT', 'F2', 11.0);
        $y -= 15;
        $this->text($contentLeft + 120, $y, 'DINAS PENDIDIKAN', 'F2', 11.0);
        $y -= 18;
        $this->text($contentLeft + 85, $y, 'SMA NEGERI 8 BANDUNG', 'F2', 15.0);
        $y -= 14;
        $this->text($contentLeft + 20, $y, 'Jl. Solontongan No. 3, Turangga, Kec. Lengkong, Kota Bandung 40264', 'F1', 9.5);
        $y -= 12;
        $this->text($contentLeft + 70, $y, 'Website: www.sman8bdg.sch.id | Email: info@sman8bdg.sch.id', 'F1', 9.0);
        $y -= 10;

        // Garis Ganda Kop Surat
        $this->line($contentLeft, $y, $contentLeft + $usableWidth, $y, 2.0);
        $y -= 3;
        $this->line($contentLeft, $y, $contentLeft + $usableWidth, $y, 0.75);
        $y -= 22;

        // 2. METADATA SURAT
        $nomorSurat = "421.3 / " . rand(10, 99) . " / SP-BK / " . date('Y');
        $this->text($contentLeft, $y, 'Nomor       : ' . $nomorSurat, 'F1', 10.5);
        $this->text($contentLeft + 330, $y, 'Bandung, ' . date('d F Y'), 'F1', 10.5);
        $y -= 15;
        $this->text($contentLeft, $y, 'Lampiran   : 1 (satu) Berkas', 'F1', 10.5);
        $y -= 15;
        $this->text($contentLeft, $y, 'Perihal      : PANGGILAN ORANG TUA / WALI MURID', 'F2', 10.5);
        $y -= 24;

        // 3. PENERIMA
        $this->text($contentLeft, $y, 'Kepada Yth.', 'F1', 10.5);
        $y -= 15;
        $this->text($contentLeft, $y, 'Bapak / Ibu / Wali Murid dari: ' . $namaSiswa, 'F2', 10.5);
        $y -= 15;
        $this->text($contentLeft, $y, 'NIS : ' . $nis . '   |   Kelas : ' . $kelas, 'F1', 10.0);
        $y -= 15;
        $this->text($contentLeft, $y, 'di Tempat', 'F1', 10.5);
        $y -= 22;

        // 4. PARAGRAF PEMBUKA
        $this->text($contentLeft, $y, 'Dengan hormat,', 'F1', 10.5);
        $y -= 16;

        $pembuka = "Sehubungan dengan hasil pembinaan kedisiplinan dan tata tertib peserta didik di lingkungan SMA Negeri 8 Bandung, kami mengundang Bapak/Ibu/Wali murid untuk hadir ke sekolah guna berkonsultasi mengenai proses pembinaan peserta didik atas nama " . $namaSiswa . " (NIS: " . $nis . ", Kelas: " . $kelas . "), yang tercatat melakukan pelanggaran tata tertib sekolah sebagai berikut:";
        $this->paragraph($contentLeft, $y, $pembuka, $usableWidth, 'F1', 10.0, 14.0);
        $y -= 8;

        // 5. TABEL PELANGGARAN
        $colWidths = [105.0, 195.0, 65.0, 130.0]; // Total 495
        $tableX = $contentLeft;
        $tableY = $y;
        $rowHeight = 20.0;

        // Header Background
        $this->stream .= "0.93 0.93 0.93 rg\n";
        $this->rect($tableX, $tableY - $rowHeight, $usableWidth, $rowHeight, 'f');
        $this->stream .= "0 0 0 rg\n";

        // Header Borders & Text
        $this->rect($tableX, $tableY - $rowHeight, $usableWidth, $rowHeight, 's', 1.0);
        $this->text($tableX + 10, $tableY - 14, 'Tanggal Kejadian', 'F2', 9.5);
        $this->text($tableX + $colWidths[0] + 10, $tableY - 14, 'Jenis Pelanggaran', 'F2', 9.5);
        $this->text($tableX + $colWidths[0] + $colWidths[1] + 15, $tableY - 14, 'Poin', 'F2', 9.5);
        $this->text($tableX + $colWidths[0] + $colWidths[1] + $colWidths[2] + 10, $tableY - 14, 'Tindakan / Sanksi', 'F2', 9.5);
        $tableY -= $rowHeight;

        // Header Vertical Dividers
        $curX = $tableX;
        foreach ($colWidths as $w) {
            $curX += $w;
            $this->line($curX, $tableY, $curX, $tableY + $rowHeight, 0.5);
        }

        // Table Rows
        $items = !empty($pelanggaran) ? $pelanggaran : [
            ['tgl_pelanggaran' => date('Y-m-d'), 'nama_pelanggaran' => 'Akumulasi Poin Pelanggaran Disiplin', 'point' => '10', 'sanksi_pelanggaran' => 'Pemanggilan Orang Tua']
        ];

        foreach ($items as $item) {
            $rHeight = 22.0;
            $this->rect($tableX, $tableY - $rHeight, $usableWidth, $rHeight, 's', 0.5);

            $tgl = substr($item['tgl_pelanggaran'] ?? '-', 0, 15);
            $namaPel = substr($item['nama_pelanggaran'] ?? '-', 0, 36);
            $poinVal = ($item['point'] ?? '0') . ' Poin';
            $sanksi = substr($item['sanksi_pelanggaran'] ?? 'Sanksi Disiplin', 0, 22);

            $this->text($tableX + 8, $tableY - 15, $tgl, 'F1', 9.0);
            $this->text($tableX + $colWidths[0] + 8, $tableY - 15, $namaPel, 'F1', 9.0);
            $this->text($tableX + $colWidths[0] + $colWidths[1] + 12, $tableY - 15, $poinVal, 'F2', 9.0);
            $this->text($tableX + $colWidths[0] + $colWidths[1] + $colWidths[2] + 8, $tableY - 15, $sanksi, 'F1', 9.0);

            // Vertical Dividers
            $curX = $tableX;
            foreach ($colWidths as $w) {
                $curX += $w;
                $this->line($curX, $tableY - $rHeight, $curX, $tableY, 0.5);
            }
            $tableY -= $rHeight;
        }

        $y = $tableY - 16;

        // 6. JADWAL KONSULTASI
        $this->text($contentLeft, $y, 'Adapun konsultasi pemanggilan orang tua / wali murid dijadwalkan dapat dilaksanakan pada:', 'F1', 10.0);
        $y -= 18;

        // Kotak Jadwal
        $this->stream .= "0.97 0.97 0.97 rg\n";
        $this->rect($contentLeft + 10, $y - 36, $usableWidth - 20, 44, 'f');
        $this->stream .= "0 0 0 rg\n";
        $this->rect($contentLeft + 10, $y - 36, $usableWidth - 20, 44, 's', 0.5);

        $this->text($contentLeft + 25, $y - 12, 'Hari / Waktu  :  Jam Kerja Sekolah (08.00 - 14.00 WIB)', 'F2', 10.0);
        $this->text($contentLeft + 25, $y - 28, 'Tempat           :  Ruang BK / Bagian Kedisiplinan SMA Negeri 8 Bandung', 'F1', 10.0);
        $y -= 52;

        // 7. PENUTUP
        $penutup = "Demikian surat pemanggilan ini kami sampaikan. Mengingat pentingnya perihal tersebut demi kelancaran proses pendidikan dan masa depan putra/putri Bapak/Ibu, atas perhatian, kerja sama, dan kehadirannya kami ucapkan terima kasih.";
        $this->paragraph($contentLeft, $y, $penutup, $usableWidth, 'F1', 10.0, 14.0);
        $y -= 15;

        // 8. TANDA TANGAN
        $ttdY = $y;
        $this->text($contentLeft + 20, $ttdY, 'Mengetahui,', 'F1', 10.0);
        $this->text($contentLeft + 20, $ttdY - 14, 'Koordinator Bagian Kedisiplinan', 'F2', 10.0);

        $this->text($contentLeft + 310, $ttdY, 'Menyetujui,', 'F1', 10.0);
        $this->text($contentLeft + 310, $ttdY - 14, 'Kepala SMA Negeri 8 Bandung', 'F2', 10.0);

        $this->text($contentLeft + 20, $ttdY - 60, $fromName, 'F2', 10.0);
        $this->line($contentLeft + 20, $ttdY - 62, $contentLeft + 190, $ttdY - 62, 0.75);
        $this->text($contentLeft + 20, $ttdY - 74, 'Bagian Kedisiplinan SMAN 8', 'F1', 9.0);

        $this->text($contentLeft + 310, $ttdY - 60, 'Drs. H. Sukandi, M.Pd.', 'F2', 10.0);
        $this->line($contentLeft + 310, $ttdY - 62, $contentLeft + 470, $ttdY - 62, 0.75);
        $this->text($contentLeft + 310, $ttdY - 74, 'NIP. 196512121990031005', 'F1', 9.0);

        // STAMP CAP SEKOLAH (Vector Circle)
        $this->stream .= "0.85 0.1 0.1 RG\n"; // Merah
        $this->stream .= "1.2 w\n";
        // Simple stamp circle & text
        $this->stream .= sprintf("%.2f %.2f 25 0 360 arc s\n", $contentLeft + 295, $ttdY - 45);
        $this->text($contentLeft + 276, $ttdY - 48, '[RESMI]', 'F2', 8.0);
        $this->stream .= "0 0 0 RG\n"; // Reset black

        // BUILD STANDARD PDF 1.4 DOCUMENT
        $contentLength = strlen($this->stream);
        $objects = [];

        $objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objects[2] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
        $objects[3] = sprintf(
            "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 %.2f %.2f] /Contents 4 0 R /Resources << /Font << /F1 5 0 R /F2 6 0 R >> >> >>",
            $this->pageWidth,
            $this->pageHeight
        );
        $objects[4] = sprintf("<< /Length %d >>\nstream\n%sendstream", $contentLength, $this->stream);
        $objects[5] = "<< /Type /Font /Subtype /Type1 /BaseFont /Times-Roman /Encoding /WinAnsiEncoding >>";
        $objects[6] = "<< /Type /Font /Subtype /Type1 /BaseFont /Times-Bold /Encoding /WinAnsiEncoding >>";

        $pdf = "%PDF-1.4\n";
        $offsets = [];
        for ($i = 1; $i <= 6; $i++) {
            $offsets[$i] = strlen($pdf);
            $pdf .= sprintf("%d 0 obj\n%s\nendobj\n", $i, $objects[$i]);
        }

        $xrefOffset = strlen($pdf);
        $pdf .= sprintf("xref\n0 7\n0000000000 65535 f \n");
        for ($i = 1; $i <= 6; $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }
        $pdf .= sprintf("trailer\n<< /Size 7 /Root 1 0 R >>\nstartxref\n%d\n%%%%EOF", $xrefOffset);

        if ($outputPath !== null) {
            $dir = dirname($outputPath);
            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
            file_put_contents($outputPath, $pdf);
        }

        return $pdf;
    }
}
