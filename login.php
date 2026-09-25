<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<section>
  <h2>Login Petugas</h2>
  <?php if ($flash): ?>
    <p class="flash flash-<?= $flash['type']; ?>">
      <?= $flash['pesan']; ?>
    </p>
  <?php endif; ?>
  <br>
  <form action="#" method="post">
    <p>
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Masukkan username" required />
    </p>
    <br />
    <p>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Masukkan password" required />
    </p>
    <br />
    <p>
      <button type="submit">Masuk</button>
    </p>
    <p>
      Belum punya akun? <a href="#">Daftar di sini</a>
    </p>
  </form>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>