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

    $pertanyaan = mysqli_query($koneksi, "SELECT * FROM pertanyaan WHERE id_quiz = '$id_quiz'");
    $pertanyaanKe = mysqli_num_rows($pertanyaan);

    if (!$data_quiz) {
        header("Location: index.php");
        exit;
    }


    if (isset($_POST['btnTambah'])) {
        $pertanyaan = htmlspecialchars($_POST['pertanyaan']);
        $jawaban1 = htmlspecialchars($_POST['jawaban1']);
        $jawaban2 = htmlspecialchars($_POST['jawaban2']);
        $jawaban3 = htmlspecialchars($_POST['jawaban3']);
        $jawaban4 = htmlspecialchars($_POST['jawaban4']);
        $jawaban_benar = htmlspecialchars($_POST['jawaban_benar']);

        $tambah_pertanyaan = mysqli_query($koneksi, "INSERT INTO pertanyaan VALUES ('', '$pertanyaan', '$jawaban1', '$jawaban2', '$jawaban3', '$jawaban4', '$jawaban_benar', '$id_quiz')");

        if ($tambah_pertanyaan) {
            echo "
                <script>
                    alert('Pertanyaan berhasil ditambahkan!')
                    window.location.href='detail_quiz.php?id_quiz=$id_quiz'
                </script>
            ";
            exit;
        } else {
            echo "
                <script>
                    alert('Pertanyaan gagal ditambahkan!')
                    window.history.back()
                </script>
            ";
            exit;
        }
    }
 ?>

<html>
<head>
    <?php include_once 'head.php'; ?>
    <title>Tambah Pertanyaan ke <?= $pertanyaanKe+1; ?> - <?= $data_quiz['nama_quiz']; ?></title>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container anti-navbar">
        <a href="detail_quiz.php?id_quiz=<?= $id_quiz; ?>" class="button">Kembali</a>
        <form method="post" class="form form-100 mt-10">
            <h3>Tambah Pertanyaan ke <?= $pertanyaanKe+1; ?> - <?= $data_quiz['nama_quiz']; ?></h3>
            <hr>
            <div class="row">
                <div class="col">
                    <label class="label" for="pertanyaan">Pertanyaan</label>
                    <textarea class="input" id="pertanyaan" name="pertanyaan" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="label" for="jawaban1">Jawaban 1</label>
                    <input class="input" type="text" id="jawaban1" name="jawaban1" required>
                </div>

                <div class="col">
                    <label class="label" for="jawaban2">Jawaban 2</label>
                    <input class="input" type="text" id="jawaban2" name="jawaban2" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="label" for="jawaban3">Jawaban 3</label>
                    <input class="input" type="text" id="jawaban3" name="jawaban3" required>
                </div>
                <div class="col">
                    <label class="label" for="jawaban4">Jawaban 4</label>
                    <input class="input" type="text" id="jawaban4" name="jawaban4" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="jawaban_benar">Jawaban Benar</label>
                    <select name="jawaban_benar" id="jawaban_benar" class="input">
                        <option value="1">Jawaban 1</option>
                        <option value="2">Jawaban 2</option>
                        <option value="3">Jawaban 3</option>
                        <option value="4">Jawaban 4</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="button align-right" name="btnTambah">Tambah Pertanyaan</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>