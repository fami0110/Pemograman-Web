<?php
  $page_title = "Daftar Anggota";
  include __DIR__ . '/../includes/header.php';

  session_start();

  $flash = $_SESSION['flash'] ?? null;
  unset($_SESSION['flash']);

   // Get All Data & Pagination //

  require __DIR__ . '/../includes/koneksi.php';
  
  $perPage = 10;
  $page = max(1, (int) ($_GET['page'] ?? 1));
  $offset = ($page - 1) * $perPage;
  $keyword = trim($_GET['q'] ?? '');

  if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE nama ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM anggota WHERE nama ILIKE :kw ORDER BY tgl_bergabung DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
  } else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM anggota ORDER BY tgl_bergabung DESC LIMIT :limit OFFSET :offset");
  }
  $stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
  $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
  $stmt->execute();

  $daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
<section>
  <div class="form-header">
    <h2>Daftar Anggota</h2>
    <a href="tambah.php" class="btn-primary">Tambah Anggota</a>
  </div>
  <?php if ($flash): ?>
    <p class="flash flash-<?= $flash['type']; ?>">
      <?= $flash['pesan']; ?>
    </p>
  <?php endif; ?>
  <div class="search-box">
    <form method="get">
      <button type="submit">Cari</button>
      <input type="text" id="search-input" name="q" placeholder="Ketik nama anggota..." value="<?= $_GET['q'] ?? '' ?>">
    </form>
  </div>
  <?php if (isset($_GET['q'])): ?>
    <p style="margin-bottom: 8px;">Hasil Pencarian: <b><?= $totalRows ?></b></p>
  <?php endif; ?>
  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>No. Anggota</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Alamat</th>
          <th>No. HP</th>
          <th>Tanggal Bergabung</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($daftarAnggota)): ?>
          <tr>
            <td colspan="7">
              Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($daftarAnggota as $anggota): ?>
            <tr>
              <td><?= $anggota['no_anggota']; ?></td>
              <td><?= $anggota['nama']; ?></td>
              <td><?= $anggota['email']; ?></td>
              <td><?= $anggota['alamat']; ?></td>
              <td><?= $anggota['no_hp']; ?></td>
              <td><?= date('d-m-Y', strtotime($anggota['tgl_bergabung'])); ?></td>
              <td>
                <a class="btn-edit" href="edit.php?id=<?= $anggota['id'] ?>">Edit</a>
                <form class="form-hapus" method="post" action="hapus.php">
                  <input type="hidden" name="id" value="<?= $anggota['id']; ?>">
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