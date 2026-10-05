# Laporan Jobsheet 8

1. Menambahkan `koneksi.php` menggunakan _PDO_.

2. Mengubah penyimpanan data (_anggota_ dan _buku_) dari menggunakan php `$_SESSION` menjadi menggunakan koneksi database (posgres).

# Modifikasi

1. Menambahkan error handling pada `proses_tambah.php` (buku dan anggota).

2. Menambahkan kolom baru pada tabel `anggota` (menyesuaikan modifikasi tabel anggota jobsheet sebelumnya).

3. Menambahkan query pencarian di halaman `/buku/list.php`.

4. Migrasi data lama (`/data/{anggota|buku}.sql`).

5. Mengubah data dashboard dari menggunakan php `$_SESSION` menjadi dinamis (via database).