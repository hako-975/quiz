<?php
    require_once 'koneksi.php';
    
    if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_user = $_SESSION['id_user'];
	$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

	$quiz = mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_user = '$id_user' ORDER BY tanggal_dibuat DESC");

	if (isset($_POST['btnCari'])) {
		$cari = $_POST['cari'];
		$quiz = mysqli_query($koneksi, "SELECT * FROM quiz INNER JOIN user ON quiz.id_user = user.id_user WHERE quiz.id_user = '$id_user' 
	        AND user.id_user = '$id_user' 
	        AND (nama_quiz LIKE '%$cari%' 
	        OR tanggal_dibuat LIKE '%$cari%'
	        OR kode_quiz LIKE '%$cari%')
			ORDER BY tanggal_dibuat ASC");
	}
?>

<html>
<head>
	<?php include_once 'head.php'; ?>
	<title>Dashboard - <?= $data_user['username']; ?></title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>

	<div class="container anti-navbar">
		<h2 class="float-left">Dashboard</h2>
		<a href="tambah_quiz.php" class="float-right button mt-10">Tambah Quiz</a>
		<div class="clear"></div>
		<form method="post" class="form-cari float-right mt-10">
	  		<input class="input" type="text" id="cari" name="cari" placeholder="Cari" required value="<?= (isset($_POST['cari'])) ? $_POST['cari'] : ''; ?>">
	  		<button type="submit" class="button align-right" name="btnCari">Cari</button>
    	</form>
    	<?php if (isset($_POST['cari'])): ?>
        	<div class="mt-10 clear">
        		<h3>Cari: <?= $_POST['cari']; ?></h3>
        		<h3>Ditemukan: <?= mysqli_num_rows($quiz); ?></h3>
	        	<a href="detail_quiz.php" class="button">Reset</a>
        	</div>
    	<?php endif ?>
		<div class="card-container mt-10 clear">
		  <?php foreach ($quiz as $dq): ?>
		  	<a href="detail_quiz.php?id_quiz=<?= $dq['id_quiz']; ?>" class="card mt-10">
			  	<h5 class="float-right-sm">Kode Quiz: <?= $dq['kode_quiz']; ?></h5>
			  	<h4 class="clear m-0"><?= $dq['nama_quiz']; ?></h4>
			  	<h5 class="float-left-sm">Diacak: <?= ($dq['soal_diacak']) ? 'Ya': 'Tidak'; ?></h5>
			  	<h5 class="float-right-sm"><?= $dq['tanggal_dibuat']; ?></h5>
			</a>
		  <?php endforeach ?>
		</div>
	</div>
</body>
</html>