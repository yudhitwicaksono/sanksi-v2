# Workspace Rules - SMAN 8 Bandung Sanksi-v2

## Automated Git "push" Command

Ketika pengguna mengetik pesan **"push"** (atau variasi seperti *"tolong push"*, *"git push"*, *"push ke github"*), agen AI **WAJIB LANGSUNG SECARA OTOMATIS** menjalankan alur sinkronisasi Git ke branch `main` repositori GitHub (`origin`) tanpa perlu konfirmasi manual berulang:

### Langkah Eksekusi Otomatis:
1. **Periksa Perubahan**:
   Jalankan `git status` untuk mendeteksi file yang diubah atau baru.
2. **Stage Semua File**:
   Jalankan `git add .`
3. **Buat Commit**:
   - Jika ada perubahan yang di-stage, buat pesan commit yang deskriptif dan relevan dengan perubahan terakhir (misal: `feat: ...`, `fix: ...`, atau `update: ...`).
   - Jalankan `git commit -m "<pesan commit>"`
4. **Pull & Merge dari Remote Main**:
   Jalankan `git pull --no-edit origin main` untuk memastikan tidak ada konflik dan kode lokal tersinkronisasi dengan remote.
5. **Push ke Branch Main GitHub**:
   Jalankan `git push origin main`.
6. **Laporan Ringkas**:
   Tampilkan laporan ringkas hasil commit, commit hash, dan status push ke branch `main` GitHub.
