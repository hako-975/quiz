<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_user = $_SESSION['id_user'];
	$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

	$id_quiz = $_GET['id_quiz'];
	$quiz = mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz = '$id_quiz' AND id_user = '$id_user'");
	$data_quiz = mysqli_fetch_assoc($quiz);
	
	$quizKu = false;
	if (isset($_SESSION['id_user'])) {
		$id_user = $_SESSION['id_user'];

		// cek apakah data acara termasuk acara ku
		if ($data_quiz['id_user'] == $id_user) {
			$quizKu = true;
		}
	}

	if ($quizKu) {
		$hapus_quiz = mysqli_query($koneksi, "DELETE FROM quiz WHERE id_quiz = '$id_quiz' AND id_user = '$id_user'");

		if ($hapus_quiz) {
			echo "
				<script>
					alert('Quiz berhasil dihapus!')
					window.location.href='detail_quiz.php?id_quiz=$id_quiz'
				</script>
			";
			exit;
		} else {
			echo "
				<script>
					alert('Quiz gagal dihapus!')
					window.history.back()
				</script>
			";
			exit;
		}
	} else {
		echo "
			<script>
				alert('Quiz gagal dihapus!')
				window.history.back()
			</script>
		";
		exit;
	}
	
?>