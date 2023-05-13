<?php
    require_once 'koneksi.php';
    
    if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_user = $_SESSION['id_user'];
	$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));
?>

<html>
<head>
	<?php include_once 'head.php'; ?>
	<title>Profile - <?= $data_user['username']; ?></title>
</head>
<body>
	<div class="container anti-navbar">
		<div class="profile">
			<h2>Profile - <?= $data_user['username']; ?></h2>
			<hr>
	        <table class="table-profile">
	        	<tr>
	        		<th>Username</th>
	        		<td>: <?= $data_user['username']; ?></td>
	        	</tr>
	        	<tr>
	        		<th>Nama Lengkap</th>
	        		<td>: <?= $data_user['nama_lengkap']; ?></td>
	        	</tr>
	        </table>
	        <a href="ubah_profile.php" class="button mr-10">Ubah Profile</a>
	        <a href="ubah_password.php" class="button">Ubah Password</a>
		</div>
	</div>
	<?php include_once 'navbar.php'; ?>

	<script src="script.js"></script>
</body>
</html>