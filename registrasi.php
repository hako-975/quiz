<?php
    require_once 'koneksi.php';
    
    if (isset($_SESSION['id_user'])) {
        echo "
            <script>
                window.location='index.php'
            </script>
        ";
        exit;
    }

    if (isset($_POST['btnRegistrasi'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $ulang_password = $_POST['ulang_password'];
        $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
        
        // check username 
        $query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
        
        if (mysqli_num_rows($query_user) > 0) {
            echo "
                <script>
                    alert('Username sudah digunakan!')
                    window.history.back();
                </script>
            ";
            exit;
        }

        if ($password != $ulang_password) {
            echo "
                <script>
                    alert('Password harus sama dengan Ketik Ulang Password!')
                    window.history.back();
                </script>
            ";
            exit;
        }
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $insert_user = mysqli_query($koneksi, "INSERT INTO user (username, password, nama_lengkap) VALUES ('$username', '$password', '$nama_lengkap')");
        if ($insert_user) {
            echo "
                <script>
                    alert('Registrasi berhasil!')
                    window.location.href='login.php'
                </script>
            ";
            exit;
        }
    }
?>

<html>
<head>
	<?php include_once 'head.php'; ?>
	<title>Login</title>
</head>
<body>
	<?php include_once 'navbar.php'; ?>

	<div class="container anti-navbar">
		<form method="post" class="form">
			<img src="img/logo.png" alt="Logo">
		  	<h2 class="title">Form Registrasi</h2>
            <hr>
            <label class="label" for="username">Username</label>
            <input class="input" type="text" id="username" name="username" required>

            <label class="label" for="password">Password</label>
            <input class="input" type="password" id="password" name="password" required>

            <label class="label" for="ulang_password">Ulang Password</label>
            <input class="input" type="password" id="ulang_password" name="ulang_password" required>

            <label class="label" for="nama_lengkap">Nama Lengkap</label>
            <input class="input" type="text" id="nama_lengkap" name="nama_lengkap" required>

            <button type="submit" class="button align-right" name="btnRegistrasi">Registrasi</button>
		</form>
	</div>
</body>
</html>