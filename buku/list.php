<?php
  $page_title = "Daftar Buku";
  include __DIR__ . '/../includes/header.php';

  $flash = $_SESSION['flash'] ?? null;
  unset($_SESSION['flash']);

  require __DIR__ . '/../includes/koneksi.php';
  
  if ($_GET["q"]) {
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE ? ORDER BY id DESC");
    $stmt->execute(["%".$_GET["q"]."%"]);
    $daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
  }
?>

<section>
  <div class="form-header">
    <h2>Daftar Buku</h2>
    <a href="tambah.php" class="btn-primary">Tambah Buku</a>
  </div>
  <?php if ($flash): ?>
    <p class="flash flash-<?= $flash['type']; ?>">
      <?= $flash['pesan']; ?>
    </p>
  <?php endif; ?>
  <div class="search-box">
    <form method="get">
      <button type="submit">Cari Judul</button>
      <input type="text" id="search-input" name="q" placeholder="Ketik judul buku..." value="<?= $_GET['q'] ?? '' ?>">
    </form>
  </div>
  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>Judul</th>
          <th>Pengarang</th>
          <th>Tahun</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarBuku) && isset($_GET['q'])): ?>
          <tr>
            <td colspan="5">
              Hasil pencarian "<?= $_GET['q'] ?>" <b>tidak ada</b>.
            </td>
          </tr>
        <?php elseif (empty($daftarBuku)): ?>
          <tr>
            <td colspan="5">
              Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($daftarBuku as $buku): ?>
            <tr>
              <td><?= $buku['judul']; ?></td>
              <td><?= $buku['pengarang']; ?></td>
              <td><?= $buku['tahun']; ?></td>
              <td><?= $buku['stok']; ?></td>
              <td>
                <button type="button">Edit</button>
                <button type="button" class="btn-hapus">Hapus</button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>