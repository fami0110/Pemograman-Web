<?php
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarAnggota = $_SESSION['anggota'] ?? [];
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
    <label for="search-input">Cari Nama Anggota</label>
    <input type="text" id="search-input" placeholder="Ketik nama anggota...">
  </div>
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
              <td><?php echo $anggota['no_anggota']; ?></td>
              <td><?php echo $anggota['nama']; ?></td>
              <td><?php echo $anggota['email']; ?></td>
              <td><?php echo $anggota['alamat']; ?></td>
              <td><?php echo $anggota['no_hp']; ?></td>
              <td><?php echo $anggota['tgl_bergabung']; ?></td>
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