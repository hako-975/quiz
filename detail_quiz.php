<?php 
    require_once 'koneksi.php';
    
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));
    
    $id_quiz = $_GET['id_quiz'];

    $data_quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_user = '$id_user' AND id_quiz = '$id_quiz'"));

    if (!$data_quiz) {
        header("Location: index.php");
        exit;
    }

    $pertanyaan = mysqli_query($koneksi, "SELECT * FROM pertanyaan WHERE id_quiz = '$id_quiz'");

 ?>

<html>
<head>
    <?php include_once 'head.php'; ?>
    <title>Detail Quiz - <?= $data_quiz['nama_quiz']; ?></title>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container anti-navbar">
        <form method="post" class="form form-100">
            <h2>Detail Quiz: <?= $data_quiz['nama_quiz']; ?></h2>
            <h3>Kode Quiz: <span id="kode_quiz"><?= $data_quiz['kode_quiz']; ?></span></h3>
            <h3>Soal Diacak: <?= ($data_quiz['soal_diacak']) ? 'Ya': 'Tidak'; ?></h3>
            <h3>Tanggal Dibuat: <?= $data_quiz['tanggal_dibuat']; ?></h3>
            <a class="button" onclick="copyContent()">Copy</a>
            <a href="start_quiz.php?kode_quiz=<?= $data_quiz['kode_quiz']; ?>" class="button">Mulai</a>
            <a href="ubah_quiz.php?id_quiz=<?= $data_quiz['id_quiz']; ?>" class="button">Ubah</a>
            <a href="hapus_quiz.php?id_quiz=<?= $data_quiz['id_quiz']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus Quiz <?= $data_quiz['nama_quiz']; ?>?')" class="button">Hapus</a>
            <hr>
            <a href="tambah_pertanyaan.php?id_quiz=<?= $data_quiz['id_quiz']; ?>" class="button float-right mt-10">Tambah Pertanyaan</a>
            <div class="table-responsive clear mt-10">
                <table cellpadding="10" cellspacing="0" border="1">
                    <tr>
                        <th>No.</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban 1</th>
                        <th>Jawaban 2</th>
                        <th>Jawaban 3</th>
                        <th>Jawaban 4</th>
                        <th>Jawaban Benar</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($pertanyaan as $dp): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= htmlspecialchars_decode($dp['pertanyaan']); ?></td>
                            <td><?= htmlspecialchars_decode($dp['jawaban1']); ?></td>
                            <td><?= htmlspecialchars_decode($dp['jawaban2']); ?></td>
                            <td><?= htmlspecialchars_decode($dp['jawaban3']); ?></td>
                            <td><?= htmlspecialchars_decode($dp['jawaban4']); ?></td>
                            <td><?= htmlspecialchars_decode($dp['jawaban_benar']); ?></td>
                            <td>
                                <a href="ubah_pertanyaan.php?id_pertanyaan=<?= $dp['id_pertanyaan']; ?>" class="button">Ubah</a>
                                <a href="hapus_pertanyaan.php?id_pertanyaan=<?= $dp['id_pertanyaan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan <?= $dp['pertanyaan']; ?>')" class="button">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </form>
    </div>

    <script>
        function copyContent() {
          var contentElement = document.getElementById("kode_quiz");
          
          var range = document.createRange();
          range.selectNode(contentElement);
          
          var selection = window.getSelection();
          selection.removeAllRanges();
          selection.addRange(range);
          
          document.execCommand("copy");
          
          selection.removeAllRanges();

          alert("Kode Quiz berhasil ter-copy!");
        }
      </script>
</body>
</html>