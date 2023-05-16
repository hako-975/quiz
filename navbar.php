<navbar class="navbar navbar-fixed-top">
  <div class="navbar-container">
    <a class="navbar-title" href="index.php"><img src="img/logo.png"> <span>Quiz</span></a>
    <form action="start_quiz.php" method="get" class="form-kode-quiz">
      <input class="input" type="text" id="kode_quiz" name="kode_quiz" placeholder="Kode Quiz" minlength="10" maxlength="10" required value="<?= (isset($_POST['kode_quiz'])) ? $_POST['kode_quiz'] : ''; ?>">
      <button type="submit" class="button align-right">Mulai</button>
    </form>
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
  <form method="post" class="form-kode-quiz-small">
    <input class="input" type="text" id="cari" name="cari" placeholder="Kode Quiz" required value="<?= (isset($_POST['cari'])) ? $_POST['cari'] : ''; ?>">
    <button type="submit" class="button align-right" name="btnCari">Mulai</button>
  </form>
</navbar>
