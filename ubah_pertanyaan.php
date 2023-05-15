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

    if (mysqli_num_rows($cek_quiz) <= 0) {
        echo "
            <script>
                alert('Pertanyaan gagal diubah!')
                window.history.back()
            </script>
        ";
        exit;
    }


    if (isset($_POST['btnUbah'])) {
        $pertanyaan = htmlspecialchars($_POST['pertanyaan']);
        $jawaban1 = htmlspecialchars($_POST['jawaban1']);
        $jawaban2 = htmlspecialchars($_POST['jawaban2']);
        $jawaban3 = htmlspecialchars($_POST['jawaban3']);
        $jawaban4 = htmlspecialchars($_POST['jawaban4']);
        $jawaban_benar = htmlspecialchars($_POST['jawaban_benar']);

        $ubah_pertanyaan = mysqli_query($koneksi, "UPDATE pertanyaan SET pertanyaan = '$pertanyaan', jawaban1 = '$jawaban1', jawaban2 = '$jawaban2', jawaban3 = '$jawaban3', jawaban4 = '$jawaban4', jawaban_benar = '$jawaban_benar' WHERE id_pertanyaan = '$id_pertanyaan' AND id_quiz = '$id_quiz'");

        if ($ubah_pertanyaan) {
            echo "
                <script>
                    alert('Pertanyaan berhasil diubah!')
                    window.location.href='detail_quiz.php?id_quiz=$id_quiz'
                </script>
            ";
            exit;
        } else {
            echo "
                <script>
                    alert('Pertanyaan gagal diubah!')
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
    <title>Ubah Pertanyaan - <?= $data_pertanyaan['pertanyaan']; ?></title>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container anti-navbar">
        <form method="post" class="form form-100">
            <h3>Ubah Pertanyaan - <?= $data_pertanyaan['pertanyaan']; ?></h3>
            <hr>
            <div class="row">
                <div class="col">
                    <label class="label" for="pertanyaan">Pertanyaan</label>
                    <textarea class="input" id="pertanyaan" name="pertanyaan" required><?= $data_pertanyaan['pertanyaan']; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="label" for="jawaban1">Jawaban 1</label>
                    <input class="input" type="text" id="jawaban1" name="jawaban1" value="<?= $data_pertanyaan['jawaban1']; ?>" required>
                </div>

                <div class="col">
                    <label class="label" for="jawaban2">Jawaban 2</label>
                    <input class="input" type="text" id="jawaban2" name="jawaban2" value="<?= $data_pertanyaan['jawaban2']; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="label" for="jawaban3">Jawaban 3</label>
                    <input class="input" type="text" id="jawaban3" name="jawaban3" value="<?= $data_pertanyaan['jawaban3']; ?>" required>
                </div>
                <div class="col">
                    <label class="label" for="jawaban4">Jawaban 4</label>
                    <input class="input" type="text" id="jawaban4" name="jawaban4" value="<?= $data_pertanyaan['jawaban4']; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="jawaban_benar">Jawaban Benar</label>
                    <select name="jawaban_benar" id="jawaban_benar" class="input">
                        <option value="<?= $data_pertanyaan['jawaban_benar']; ?>">Jawaban <?= $data_pertanyaan['jawaban_benar']; ?></option>
                        <option disabled>------------------</option>
                        <option value="1">Jawaban 1</option>
                        <option value="2">Jawaban 2</option>
                        <option value="3">Jawaban 3</option>
                        <option value="4">Jawaban 4</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="button align-right" name="btnUbah">Ubah Pertanyaan</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>