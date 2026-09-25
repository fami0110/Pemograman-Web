<?php
	session_start();
	$__jobsheetRoot = dirname(__DIR__);
	$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
	$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
	$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
	<link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>

<body>
	<header>
		<a href="<?php echo $base; ?>index.php">
			<h1>SIMPUS-Mini</h1>
		</a>
		<button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-
			label="Menu">&#9776;</button>
		<nav>
			<ul>
				<li><a href="<?php echo $base; ?>buku/list.php">Buku</a></li>
				<li><a href="<?php echo $base; ?>anggota/list.php">Anggota</a></li>
			</ul>
		</nav>
	</header>
	<main>