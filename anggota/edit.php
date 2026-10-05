<?php
	$page_title = "Edit Anggota";
	include __DIR__ . '/../includes/header.php';

	$flash = $_SESSION['flash'] ?? null;
	unset($_SESSION['flash']);

	$id = $_GET['id'] ?? null;
	if (!$id) {
		header('Location: list.php');
		exit;
	}

	require __DIR__ . '/../includes/koneksi.php';
	$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
	$stmt->execute(['id' => $id]);
	$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$anggota) {
		header('Location: list.php');
		exit;
	}
?>

<section>
  <h2>Edit Anggota</h2>
  <?php if ($flash): ?>
    <p class="flash flash-<?= $flash['type']; ?>">
      <?= $flash['pesan']; ?>
    </p>
  <?php endif; ?>
  <br>
  <form id="form-tambah" method="post" action="proses_edit.php">
	<input type="hidden" name="id" value="<?= $anggota['id'] ?>">
    <article>
      <p>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= $anggota['nama'] ?>" required />
      </p>
      <p>
        <label for="no_anggota">No. Anggota</label>
        <input type="text" id="no_anggota" name="no_anggota" value="<?= $anggota['no_anggota'] ?>" required />
      </p>
      <p>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $anggota['email'] ?>" />
      </p>
      <p>
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" value="<?= $anggota['alamat'] ?>" />
      </p>
      <p>
        <label for="no_hp">No. HP</label>
        <input type="text" id="no_hp" name="no_hp" value="<?= $anggota['no_hp'] ?>" />
      </p>
    </article>
    <p>
      <button type="submit">Simpan</button>
    </p>
  </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>