<?php
  

	$page_title = "Edit Buku";
	include __DIR__ . '/../includes/header.php';
	
	$flash = $_SESSION['flash'] ?? null;
	unset($_SESSION['flash']);

	$id = $_GET['id'] ?? null;
	if (!$id) {
		header('Location: list.php');
		exit;
	}

	require __DIR__ . '/../includes/koneksi.php';
	$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
	$stmt->execute(['id' => $id]);
	$buku = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$buku) {
		header('Location: list.php');
		exit;
	}
?>

<section>
  <h2>Edit Buku</h2>
  <?php if ($flash): ?>
    <p class="flash flash-<?= $flash['type']; ?>">
      <?= $flash['pesan']; ?>
    </p>
  <?php endif; ?>
  <br>
  <form id="form-tambah" method="post" action="proses_edit.php">
	<input type="hidden" name="id" value="<?= $buku['id'] ?>">
    <article>
      <p>
        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" value="<?= $buku['judul'] ?>" required />
      </p>
      <p>
        <label for="pengarang">Pengarang</label>
        <input type="text" id="pengarang" name="pengarang" value="<?= $buku['pengarang'] ?>" required />
      </p>
      <p>
        <label for="tahun">Tahun Terbit</label>
        <input type="number" id="tahun" name="tahun" min="1900" max="2026" value="<?= $buku['tahun'] ?>" required />
      </p>
      <p>
        <label for="isbn">ISBN</label>
        <input type="text" id="isbn" name="isbn" value="<?= $buku['isbn'] ?>" />
      </p>
      <p>
        <label for="stok">Stok</label>
        <input type="number" id="stok" name="stok" min="0" value="<?= $buku['stok'] ?>" required />
      </p>
      <p>
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori">
			<?php foreach ([
				"Laga", "Drama", "Sejarah", "Inspiratif", "Sastra", "Romantis", "Self-Improvement",
			] as $opt): ?>
				<option value="<?= $opt; ?>" <?= (strtolower($buku['kategori']) === $opt) ? 'selected' : ''; ?>>
					<?= $opt; ?>
				</option>
			<?php endforeach; ?>
        </select>
      </p>
    </article>
    <p>
      <button type="submit">Simpan</button>
    </p>
  </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>