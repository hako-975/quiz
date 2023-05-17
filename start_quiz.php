<?php
    require_once 'koneksi.php';
    
	$kode_quiz = $_GET['kode_quiz'];
	$data_quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE kode_quiz = '$kode_quiz'"));

	$id_quiz = $data_quiz['id_quiz'];
    $data_quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'"));
	
	if ($data_quiz['soal_diacak'] == 1) {
		$pertanyaan = mysqli_query($koneksi, "SELECT * FROM pertanyaan WHERE id_quiz = '$id_quiz' ORDER BY RAND()");
	}
	else
	{
		$pertanyaan = mysqli_query($koneksi, "SELECT * FROM pertanyaan WHERE id_quiz = '$id_quiz'");
	}


	if (isset($_POST['btnSelesai'])) {
		$total_jawaban_benar = 0; 
		$total_jawaban_salah = 0;
		$total_soal = 0;

		$answers = array();
	    foreach ($pertanyaan as $index => $data_pertanyaan) {
	        $answer = $_POST['jawaban' . ($index + 1)];
	        $answers[] = $answer;

	        if ($answer == $data_pertanyaan['jawaban_benar']) {
	        	$total_jawaban_benar++;
	        } else {
	        	$total_jawaban_salah++;
	        }
	    }

	    $total_soal = $total_jawaban_benar + $total_jawaban_salah;


	}
?>

<html>
<head>
	<?php include_once 'head.php'; ?>
	<title>Mulai Quiz <?= ($data_quiz) ? $data_quiz['nama_quiz'] : ''; ?></title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>

	<div class="container anti-navbar">
		<h2>Kode Quiz: <?= $kode_quiz; ?></h2>
		<?php if (($data_quiz) == false): ?>
			<h2>Quiz tidak ditemukan! <br><br> Periksa kembali Kode Quiz Anda!</h2>
		<?php else: ?>
			<div class="bg-quiz">
				<div class="row">
					<?php if (isset($_POST['btnSelesai'])): ?>
						<div class="col">
							<h2>Hasil dari Quiz <?= $data_quiz['nama_quiz']; ?></h2>
							<hr>
							<p>Jawaban Benar: <?= $total_jawaban_benar; ?></p>
							<p>Jawaban Salah: <?= $total_jawaban_salah; ?></p>
							<h3>Skor: <?= $total_jawaban_benar; ?>/<?= $total_soal; ?></h3>
							<a href="start_quiz.php?kode_quiz=<?= $data_quiz['kode_quiz']; ?>" class="button">Mulai Quiz Lagi</a>
						</div>
					<?php else: ?>
						<div class="col text-center">
							<h2>Quiz <?= $data_quiz['nama_quiz']; ?></h2>
							<hr>
							<button type="button" class="button" id="mulaiButton" onclick="mulaiQuiz()">Mulai Quiz</button>
						</div>
					<?php endif ?>
				</div>	
				<form method="post" id="soalQuiz" class="form-pertanyaan" style="display: none;">
				    <?php $i = 1; ?>
					<?php foreach ($pertanyaan as $data_pertanyaan): ?>
					    <div class="pertanyaan">
					        <div class="row">
					            <div class="col">
					                <label><?= $i; ?>. <?= $data_pertanyaan['pertanyaan']; ?></label>
					            </div>
					        </div>
					        <div class="row">
					            <div class="col">
					                <input type="radio" id="jawaban<?= $i; ?>_1" value="1" name="jawaban<?= $i; ?>" required>
					                <label for="jawaban<?= $i; ?>_1"><?= $data_pertanyaan['jawaban1']; ?></label>
					            </div>
					            <div class="col">
					                <input type="radio" id="jawaban<?= $i; ?>_2" value="2" name="jawaban<?= $i; ?>" required>
					                <label for="jawaban<?= $i; ?>_2"><?= $data_pertanyaan['jawaban2']; ?></label>
					            </div>
					        </div>
					        <div class="row">
					            <div class="col">
					                <input type="radio" id="jawaban<?= $i; ?>_3" value="3" name="jawaban<?= $i; ?>" required>
					                <label for="jawaban<?= $i; ?>_3"><?= $data_pertanyaan['jawaban3']; ?></label>
					            </div>
					            <div class="col">
					                <input type="radio" id="jawaban<?= $i; ?>_4" value="4" name="jawaban<?= $i; ?>" required>
					                <label for="jawaban<?= $i; ?>_4"><?= $data_pertanyaan['jawaban4']; ?></label>
					            </div>
					        </div>
					    </div>
					    <hr>
					    <?php $i++; ?>
					<?php endforeach ?>

				    <button type="submit" name="btnSelesai" class="button align-right">Selesai</button>
				</form>

			</div>
		<?php endif ?>
	</div>

	<script>
		function mulaiQuiz() {
			let mulaiButton = document.getElementById("mulaiButton");
			mulaiButton.style.display = "none";

			let soalQuizElement = document.getElementById("soalQuiz");
			soalQuizElement.style.display = "block";
		}	
	</script>
</body>
</html>