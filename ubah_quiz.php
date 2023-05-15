<?php 
    require_once 'koneksi.php';
    
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));
    
    $id_quiz = $_GET['id_quiz'];

    $data_quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz = '$id_quiz' AND id_user = '$id_user'"));

    if (isset($_POST['btnUbah'])) {
        $nama_quiz = htmlspecialchars($_POST['nama_quiz']);
        $kode_quiz = htmlspecialchars($_POST['kode_quiz']);

        if (isset($_POST['soal_diacak'])) {
            $soal_diacak = $_POST['soal_diacak'];
            
            if ($soal_diacak == 'on') {
                $soal_diacak = '1';
            } else {
                $soal_diacak = '0';
            }
        } else {
            $soal_diacak = '0';
        }


        $ubah_quiz = mysqli_query($koneksi, "UPDATE quiz SET nama_quiz = '$nama_quiz', kode_quiz = '$kode_quiz', soal_diacak = '$soal_diacak' WHERE id_quiz = '$id_quiz' AND id_user = '$id_user'");

        if ($ubah_quiz) {
            echo "
                <script>
                    alert('Quiz berhasil diubah!')
                    window.location.href='detail_quiz.php?id_quiz=$id_quiz'
                </script>
            ";
            exit;
        } else {
            echo "
                <script>
                    alert('Quiz gagal diubah!')
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
    <title>Ubah Quiz - <?= $data_quiz['nama_quiz']; ?></title>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container anti-navbar">
        <form method="post" class="form form-100">
            <h3>Ubah Quiz - <?= $data_quiz['nama_quiz']; ?></h3>
            <hr>
            <div class="row">
                <div class="col">
                    <label class="label" for="nama_quiz">Nama Quiz</label>
                    <input class="input" type="text" id="nama_quiz" name="nama_quiz" required value="<?= $data_quiz['nama_quiz']; ?>">
                </div>
                <div class="col">
                    <label class="label" for="kode_quiz">Kode Quiz</label>
                    <input class="input" type="text" id="kode_quiz" name="kode_quiz" value="<?= $data_quiz['kode_quiz']; ?>" minlength="10" maxlength="10" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="soal_diacak" id="soal_diacak" <?= ($data_quiz['soal_diacak']) ? 'checked' : ''; ?>>
                    <label for="soal_diacak">Soal Diacak</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="button align-right" name="btnUbah">Ubah Quiz</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>