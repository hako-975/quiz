<?php 
    require_once 'koneksi.php';
    
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

    $quiz = mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_user = '$id_user' ORDER BY tanggal_dibuat DESC");

    $kode_quiz = '';
    
    do 
    {
      $kode_quiz = strtoupper(substr(uniqid(), -10));
      $query = "SELECT kode_quiz FROM quiz WHERE kode_quiz = '$kode_quiz'";
      $result = mysqli_query($koneksi, $query);
    } while(mysqli_num_rows($result) > 0);

    if (isset($_POST['btnTambah'])) {
        $nama_quiz = htmlspecialchars($_POST['nama_quiz']);
        $kode_quiz = htmlspecialchars($_POST['kode_quiz']);
        $tanggal_dibuat = date("Y-m-d H:i");

        $soal_diacak = $_POST['soal_diacak'];

        if ($soal_diacak == 'on') {
            $soal_diacak = '1';
        }

        $tambah_quiz = mysqli_query($koneksi, "INSERT INTO quiz VALUES ('', '$nama_quiz', '$kode_quiz', '$soal_diacak', '$tanggal_dibuat', '$id_user')");

        if ($tambah_quiz) {
            $id_quiz = mysqli_insert_id($koneksi);

            echo "
                <script>
                    alert('Quiz berhasil ditambahkan!')
                    window.location.href='tambah_pertanyaan.php?id_quiz=$id_quiz'
                </script>
            ";
            exit;
        } else {
            echo "
                <script>
                    alert('Quiz gagal ditambahkan!')
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
    <title>Tambah Quiz</title>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container anti-navbar">
        <form method="post" class="form form-100">
            <h3>Tambah Quiz</h3>
            <hr>
            <div class="row">
                <div class="col">
                    <label class="label" for="nama_quiz">Nama Quiz</label>
                    <input class="input" type="text" id="nama_quiz" name="nama_quiz" required>
                </div>
                <div class="col">
                    <label class="label" for="kode_quiz">Kode Quiz</label>
                    <input class="input" type="text" id="kode_quiz" name="kode_quiz" value="<?= $kode_quiz; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="checkbox" name="soal_diacak" id="soal_diacak">
                    <label for="soal_diacak">Soal Diacak</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="button align-right" name="btnTambah">Tambah Quiz</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>