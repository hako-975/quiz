<?php 
    require_once 'koneksi.php';
    
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));
    
    $id_quiz = $_GET['id_quiz'];

    $quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_user = '$id_user' AND id_quiz = '$id_quiz'"));

    if (!$quiz) {
        header("Location: index.php");
        exit;
    }

    $pertanyaan = mysqli_query($koneksi, "SELECT * FROM pertanyaan WHERE id_quiz = '$id_quiz'");

 ?>

<html>
<head>
    <?php include_once 'head.php'; ?>
    <title>Detail Quiz - <?= $quiz['nama_quiz']; ?></title>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container anti-navbar">
        <form method="post" class="form form-100">
            <h3>Detail Quiz - <?= $quiz['nama_quiz']; ?></h3>
            <hr>
            <h4 class="float-left">Soal Diacak - <?= ($quiz['soal_diacak']) ? 'Ya': 'Tidak'; ?></h4>
            <a href="tambah_pertanyaan.php?id_quiz=<?= $quiz['id_quiz']; ?>" class="button float-right mt-10">Tambah Pertanyaan</a>
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

</body>
</html>