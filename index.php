<?php
require 'config/koneksi.php';
require 'components/components.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM roti");
$roti = [];
while ($row = mysqli_fetch_assoc($result)) {
    $roti[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head><?= head("Dashboard"); ?></head>
<body>
  <?php navbar() ?>

  <main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Selamat Datang, <?= $_SESSION['username']; ?></h2>
      
      <a href="tambah.php">
          <button type="button" class="btn btn-primary shadow-sm">
            + Tambah Menu Roti
          </button>
      </a>
    </div>

    <section class="d-flex flex-wrap gap-4 mt-4 justify-content-start">
      <?php if (empty($roti)) : ?>
          <div class="alert alert-info w-100">Belum ada data roti.</div>
      <?php else : ?>
          <?php foreach ($roti as $r) : ?>
             <?php cardMenu($r); ?>
          <?php endforeach; ?>
      <?php endif; ?>
    </section>
  </main>

  <?php footer() ?>
</body>
</html>