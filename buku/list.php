<?php
  $page_title = "Daftar Buku";
  include __DIR__ . '/../includes/header.php';

  session_start();

  $flash = $_SESSION['flash'] ?? null;
  unset($_SESSION['flash']);

  // Get All Data & Pagination //

  require __DIR__ . '/../includes/koneksi.php';
  
  $perPage = 8;
  $page = max(1, (int) ($_GET['page'] ?? 1));
  $offset = ($page - 1) * $perPage;
  $keyword = trim($_GET['q'] ?? '');

  if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :kw OR pengarang ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
  } else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM buku ORDER BY id DESC LIMIT :limit OFFSET :offset");
  }
  $stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
  $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
  $stmt->execute();

  $daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $totalPages = max(1, (int) ceil($totalRows / $perPage));
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
      <button type="submit">Cari</button>
      <input type="text" id="search-input" name="q" placeholder="Ketik judul buku..." value="<?= $keyword ?>">
    </form>
  </div>
  <?php if (isset($_GET['q'])): ?>
    <p style="margin-bottom: 8px;">Hasil Pencarian: <b><?= $totalRows ?></b></p>
  <?php endif; ?>
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
                <a class="btn-edit" href="edit.php?id=<?= $buku['id'] ?>">Edit</a>
                <form class="form-hapus" method="post" action="hapus.php">
                  <input type="hidden" name="id" value="<?= $buku['id']; ?>">
                  <button type="submit" class="btn-hapus">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <nav class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="list.php?page=<?= $i; ?><?= ($keyword !== '') ? '&q='.urlencode($keyword) : ''; ?>" class="<?= ($i === $page) ? 'active' : ''; ?>">
        <?= $i; ?>
      </a>
    <?php endfor; ?>
  </nav>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>