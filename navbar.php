<navbar class="navbar navbar-fixed-top">
  <div class="navbar-container">
    <a class="navbar-title" href="index.php"><img src="img/logo.png"> <span>Quiz</span></a>
      <div class="navbar-nav">
        <?php if (isset($_SESSION['id_user'])): ?>
          <a class="button mr-10" href="profile.php">Profile</a>
          <a class="button" href="logout.php">Logout</a>
        <?php else: ?>
          <a class="button mr-10" href="registrasi.php">Registrasi</a>
          <a class="button" href="login.php">Login</a>
        <?php endif ?>
      </div>
  </div>
</navbar>
