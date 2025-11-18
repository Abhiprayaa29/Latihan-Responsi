<?php
require 'config/koneksi.php';
require 'components/components.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

$result = mysqli_query($koneksi, "SELECT * FROM roti WHERE id_roti = $id");
$roti = mysqli_fetch_assoc($result);

if (!$roti) {
    echo "<script>alert('Data tidak ditemukan!'); document.location.href = 'index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head><?= head("Detail " . $roti['nama_roti']); ?></head>
<body>
  <?php navbar() ?>

  <main class="container my-5">
    <p class="text-muted">Dashboard / <?= $roti['nama_roti']; ?></p> 
    <h1 class="mb-4">Detail Data Roti</h1>

    <div class="card p-4 shadow-lg">
      <div class="d-flex flex-wrap gap-5 align-items-center">
        <img src="<?= $roti['gambar_url']; ?>" alt="<?= $roti['nama_roti']; ?>" class="rounded w-50 object-fit-cover" style="max-height: 400px;">

        <div class="w-100" style="max-width: 500px;">
          <h2 class="display-5 mb-3" style="color: #4B774B;"><?= $roti['nama_roti']; ?></h2>

          <div class="mb-3">
            <p class="fs-5 m-0">Jenis Roti: <span class="fw-bold"><?= $roti['jenis_roti']; ?></span></p>
            <p class="fs-5 m-0">Harga: <span class="fw-bold">Rp <?= number_format($roti['harga'], 0, ',', '.'); ?></span></p>
            <p class="fs-5 m-0">Status: 
              <span class="fw-bold <?= ($roti['status'] == 'Tersedia') ? 'text-success' : 'text-danger'; ?>">
                <?= $roti['status']; ?>
              </span>
            </p>
          </div>

           <?php if($roti['status'] == 'Tersedia') : ?>
               <div class="mt-3">
                   <a href="logic/status.logic.php?id=<?= $roti['id_roti']; ?>" class="btn btn-primary">Update Status</a>
               </div>
           <?php endif; ?>

          <div class="mt-4 d-flex gap-2">
            <a href="update.php?id=<?= $roti['id_roti']; ?>" class="btn btn-warning btn-sm text-white">Edit Data</a>
            <a href="logic/delete.logic.php?id=<?= $roti['id_roti']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus Data</a>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php footer() ?>
</body>
</html>