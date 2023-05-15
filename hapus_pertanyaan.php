<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_user = $_SESSION['id_user'];
	$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

	$id_pertanyaan = $_GET['id_pertanyaan'];
	$pertanyaan = mysqli_query($koneksi, "SELECT * FROM pertanyaan WHERE id_pertanyaan = '$id_pertanyaan'");
	$data_pertanyaan = mysqli_fetch_assoc($pertanyaan);
	$id_quiz = $data_pertanyaan['id_quiz'];
	$cek_quiz = mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz = '$id_quiz' AND id_user = '$id_user'");

	if (mysqli_num_rows($cek_quiz) > 0) {
		$hapus_pertanyaan = mysqli_query($koneksi, "DELETE FROM pertanyaan WHERE id_pertanyaan = '$id_pertanyaan'");

		if ($hapus_pertanyaan) {
			echo "
				<script>
					alert('Pertanyaan berhasil dihapus!')
					window.location.href='detail_quiz.php?id_quiz=$id_quiz'
				</script>
			";
			exit;
		} else {
			echo "
				<script>
					alert('Pertanyaan gagal dihapus!')
					window.history.back()
				</script>
			";
			exit;
		}
	} else {
		echo "
			<script>
				alert('Pertanyaan gagal dihapus!')
				window.history.back()
			</script>
		";
		exit;
	}
	
?>