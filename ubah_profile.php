<?php 
    require_once 'koneksi.php';

    if (!isset($_SESSION['id_user'])) {
    	header("Location: login.php");
    	exit;
    }

    $id_user = $_SESSION['id_user'];
    $data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

    if (isset($_POST['btnUbah'])) {
        $username = $_POST['username'];
        $nama_lengkap = $_POST['nama_lengkap'];

        // check username 
        $old_username = $data_user['username'];
        if ($username != $old_username) {
            $check_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
            if (mysqli_num_rows($check_username)) {
                echo "
                    <script>
                        alert('Username telah digunakan!')
                        window.history.back();
                    </script>
                ";
                exit;
            }
        }


        $ubah_profile = mysqli_query($koneksi, "UPDATE user SET username = '$username', nama_lengkap = '$nama_lengkap' WHERE id_user='$id_user'");
        if ($ubah_profile) {
            echo "
                <script>
                    alert('Profile berhasil diubah!')
                    window.location.href='profile.php'
                </script>
            ";
            exit;
        } else {
            echo "
                <script>
                    alert('Profile gagal diubah!')
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
    <title>Ubah Profile - <?= $data_user['username']; ?></title>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container anti-navbar">
        <form method="post" class="form form-left">
            <h3>Ubah Profile - <?= $data_user['username']; ?></h3>
            <hr>
            <label class="label" for="username">Username</label>
            <input class="input" type="text" id="username" name="username" value="<?= $data_user['username']; ?>" required>

            <label class="label" for="nama_lengkap">Nama Lengkap</label>
            <input class="input" type="text" id="nama_lengkap" name="nama_lengkap" value="<?= $data_user['nama_lengkap']; ?>" required>

            <button type="button" onclick="window.history.back()" class="button float-left">Kembali</button>
            <button type="submit" class="button float-right" name="btnUbah">Ubah Profile</button>
            <div class="clear"></div>
        </form>
    </div>
</body>
</html>