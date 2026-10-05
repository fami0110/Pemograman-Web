<?php
session_start();

require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$email = trim($_POST['email'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');

$errors = [];

if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}

if ($no_anggota === '') {
    $errors[] = "Nomor anggota wajib diisi.";
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}

if ($alamat === '') {
    $errors[] = "Alamat wajib diisi.";
}

if ($no_hp !== '' && !preg_match('/^\+?[0-9]{9,15}$/', $no_hp)) {
    $errors[] = "Nomor HP tidak valid (hanya angka 9-15 digit).";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO anggota (nama, no_anggota, email, alamat, no_hp, tgl_bergabung)
        VALUES (:nama, :no_anggota, :email, :alamat, :no_hp, :tgl_bergabung)
        RETURNING id"
    );

    $stmt->execute([
        'nama' => $nama,
        'no_anggota' => $no_anggota,
        'email' => $email,
        'alamat' => $alamat,
        'no_hp' => $no_hp,
        'tgl_bergabung' => date('Y-m-d H:i:s'),
    ]);
    
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];

    header('Location: list.php');
    
} catch (PDOException $e) {
    $messages = $e->getMessage();

    if (str_contains($messages, "Unique violation")) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Kolom <b>No. Anggota</b> tidak boleh duplikat!'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => $messages];
    }

    header('Location: tambah.php');
}

exit;