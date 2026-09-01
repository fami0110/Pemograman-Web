# Jawaban Pertanyaan Jobsheet 1

1. Kenapa field "Alamat" dan "No. HP" tidak diberi required, sedangkan "Nama" dan "No. Anggota" diberi?
   – Karena data “Alamat” dan “No. HP” bersifat opsional, alias tidak wajib untuk diisi.

2. Apa yang akan terjadi (di browser) kalau kamu klik tombol "Simpan" tanpa mengisi field "Nama"? Coba buka filenya di browser dan praktikkan.
   – Muncul popup di field “Nama” yang bertuliskan “Please fill out this field.”

3. Form ini juga belum punya action pada tag `<form>`-nya. Apa dampaknya saat tombol "Simpan" ditekan?
   - Halaman akan otomatis ke-redirect ke halaman yang sama, namun dengan URL berikut:
   ```
   http://127.0.0.1:8080/anggota/tambah.html?nama=as&no_anggota=as&email=masandofami%40gmail.com&alamat=as&no_hp=as
   ```
   Hal ini disebabkan karena secara default action pada tag form memiliki method GET, sehingga semua data yang disubmit akan dikirimkan dalam bentuk URL
