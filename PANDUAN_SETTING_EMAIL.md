# Panduan Pengaturan & Penggunaan Fitur Kirim Email Surat Panggilan
### Sistem Informasi Pelanggaran & Tata Tertib Siswa - SMA Negeri 8 Bandung

Dokumen ini berisi penjelasan lengkap mengenai konfigurasi, alur kerja, dan langkah-langkah penggunaan fitur **Kirim Surat Panggilan ke Email Wali Murid**.

---

## 1. Daftar File Terkait Pengiriman Email di Repository

Seluruh file yang mengatur dan mengoperasikan fitur pengiriman email tersimpan rapi di dalam repositori ini:

| File / Direktori | Deskripsi & Peran |
|---|---|
| [`.env`](file:///.env) | Konfigurasi environment lokal, termasuk kredensial SMTP (`email.SMTPUser`, `email.SMTPPass`, dll). |
| [`.env.example`](file:///.env.example) | Template acuan konfigurasi environment untuk instalasi baru. |
| [`app/Config/Email.php`](file:///app/Config/Email.php) | Konfigurasi dasar sistem Email CodeIgniter 4 (membaca `.env` secara dinamis, tipe email HTML, port, dsb). |
| [`app/Libraries/PdfSuratGenerator.php`](file:///app/Libraries/PdfSuratGenerator.php) | Generator berkas resmi PDF Surat Panggilan murni PHP (standar PDF 1.4, tanpa dependensi eksternal). |
| [`app/Views/surat_panggilan/email_surat_panggilan.php`](file:///app/Views/surat_panggilan/email_surat_panggilan.php) | Template tampilan HTML surat panggilan resmi dengan widget softfile berkas PDF terlampir. |
| [`app/Views/surat_panggilan/surat_penggilan_orang_tua.php`](file:///app/Views/surat_panggilan/surat_penggilan_orang_tua.php) | Halaman tabel daftar siswa (≥10 poin) dilengkapi tombol aksi **Kirim Email** dan indikator status. |
| [`app/Controllers/Main.php`](file:///app/Controllers/Main.php) | Method `kirim_email_surat()` dan `download_pdf_surat()` yang memproses pembuatan PDF, attachment, dan pengiriman email. |
| [`app/Config/Routes.php`](file:///app/Config/Routes.php) | Pendaftaran routing URL `main/kirim_email_surat` dan `main/download_pdf_surat`. |
| `writable/attachments/` | Folder penyimpanan file `.pdf` surat panggilan yang dilampirkan ke email. |
| `writable/sent_emails/` | Direktori otomatis untuk menyimpan arsip salinan HTML setiap surat panggilan yang telah diproses. |

---

## 2. Aturan Data Pengirim, Penerima & Lampiran Softfile PDF

Sesuai ketentuan sistem:
- **Pengirim (From)**: Diambil otomatis dari database tabel `bagian_kedisiplinan.email` dan `bagian_kedisiplinan.nama_guru` untuk akun dengan `role = 'Admin'` (misal: akun admin dengan email `admin@gmail.com`).
- **Penerima (To)**: Diambil otomatis dari kolom `wali_murid.email_wali`.
- **Subjek Email**: `Panggilan Orang Tua / Wali Murid [siswa.nama_siswa]`.
- **Isi Surat Email**: Memuat format surat resmi pemanggilan orang tua yang mencakup:
  1. Salam pembuka (*Dengan hormat,*).
  2. Paragraf pemanggilan peserta didik atas nama siswa terkait.
  3. Tabel rincian pelanggaran (Tanggal Kejadian, Jenis Pelanggaran, Poin, Tindakan/Sanksi).
  4. Jadwal kehadiran ke Ruang BK / Bagian Kedisiplinan SMAN 8 Bandung.
  5. Paragraf penutup resmi.
  6. **Widget Softfile PDF Terlampir**: Menggantikan blok tanda tangan manual pada email dengan informasi berkas softfile PDF resmi (`Surat_Panggilan_[Nama]_[NIS].pdf`) lengkap dengan tombol unduh langsung.
- **Lampiran Berkas PDF (Attachment)**: Surat panggilan resmi berformat `.pdf` dibuat secara otomatis dan dilampirkan langsung ke dalam email penerima.

---

## 3. Langkah-Langkah Setting Email (SMTP)

Agar email dapat terkirim secara langsung ke alamat email wali murid, lakukan pengaturan SMTP pada file `.env`:

### Opsi A: Menggunakan Gmail (Disarankan)

1. **Aktifkan Verifikasi 2 Langkah di Akun Google**:
   - Buka [Google Account Security](https://myaccount.google.com/security).
   - Pastikan **2-Step Verification** (Verifikasi 2 Langkah) telah aktif.
2. **Buat Sandi Aplikasi (App Password)**:
   - Masuk ke menu **Sandi Aplikasi** (*App Passwords*): [https://myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords).
   - Beri nama aplikasi, misalnya: `Sanksi SMAN 8`.
   - Klik **Buat** (*Create*), Google akan memberikan 16 karakter sandi (contoh: `abcd efgh ijkl mnop`).
3. **Buka file `.env` di root proyek**:
   Temukan bagian `EMAIL (SMTP) CONFIGURATION` dan sesuaikan nilainya:
   ```ini
   #--------------------------------------------------------------------
   # EMAIL (SMTP) CONFIGURATION
   #--------------------------------------------------------------------
   email.protocol = 'smtp'
   email.SMTPHost = 'smtp.gmail.com'
   email.SMTPUser = 'email_anda@gmail.com'
   email.SMTPPass = 'abcdefghijklmnop'       # 16 karakter sandi aplikasi tanpa spasi
   email.SMTPPort = 587
   email.SMTPCrypto = 'tls'
   email.mailType = 'html'
   email.fromEmail = 'admin@gmail.com'
   email.fromName = 'Bagian Kedisiplinan SMAN 8 Bandung'
   email.SMTPTimeout = 15
   ```

---

### Opsi B: Menggunakan Mailtrap / Mailpit (Untuk Uji Coba Offline / Dev)

Jika ingin menguji coba tanpa mengirim ke inbox asli:
```ini
email.protocol = 'smtp'
email.SMTPHost = 'sandbox.smtp.mailtrap.io'
email.SMTPUser = 'username_mailtrap_anda'
email.SMTPPass = 'password_mailtrap_anda'
email.SMTPPort = 2525
email.SMTPCrypto = 'tls'
email.mailType = 'html'
```

---

### Opsi C: Menggunakan Email Hosting Sekolah / Webmail (cPanel / Zimbra)

```ini
email.protocol = 'smtp'
email.SMTPHost = 'mail.sman8bandung.sch.id'
email.SMTPUser = 'kedisiplinan@sman8bandung.sch.id'
email.SMTPPass = 'password_email_anda'
email.SMTPPort = 465
email.SMTPCrypto = 'ssl'
email.mailType = 'html'
```

---

## 4. Cara Menggunakan Fitur Kirim Email

1. Login ke aplikasi sebagai **Admin** atau **Bagian Kedisiplinan**.
2. Klik menu **Surat Panggilan (≥10 Poin)** di sidebar kiri (URL: `main/surat_penggilan_orang_tua`).
3. Pada tabel siswa yang memenuhi syarat pemanggilan:
   - Kolom **Nama Wali Murid & Email** akan menampilkan nama dan alamat email wali murid yang terdaftar.
   - Kolom **Status Surat** akan menandai apakah surat *Belum Diproses*, *Sudah Dicetak*, atau *Email Terkirim*.
4. Klik tombol **<i class="fa-solid fa-paper-plane"></i> Kirim Email** pada baris siswa yang dituju.
5. Konfirmasi popup peringatan pengiriman.
6. Sistem akan otomatis memproses pengiriman:
   - Pesan notifikasi sukses akan muncul di atas tabel.
   - Status surat siswa otomatis terupdate menjadi **Email Terkirim**.
   - Salinan arsip surat tersimpan di folder `writable/sent_emails/`.

---

## 5. Salinan Arsip Email (Audit Trail)

Setiap kali tombol **Kirim Email** diklik, sistem secara otomatis mengarsipkan dokumen HTML surat panggilan ke direktori:
```
writable/sent_emails/email_[TANGGAL_WAKTU]_[NIS].html
```
File ini dapat dibuka langsung di browser untuk melihat pratinjau persis surat yang telah diterima oleh wali murid.
