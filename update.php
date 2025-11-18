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
<head><?= head("Update Data Roti"); ?></head>
<body>
  <?php navbar() ?>

  <main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Update Data Menu Roti: <span class="fw-bold"><?= $roti['nama_roti']; ?></span></h2>
    </div>

    <div class="card p-4 shadow-sm">
      <form action="logic/update.logic.php" method="post">
        
        <input type="hidden" name="id" value="<?= $roti['id_roti']; ?>">

        <div class="mb-3">
          <label for="nama" class="form-label fw-bold">Nama Roti</label>
          <input name="nama_roti" type="text" class="form-control" id="nama" value="<?= $roti['nama_roti']; ?>" required>
        </div>

        <div class="mb-3">
          <label for="jenis" class="form-label fw-bold">Jenis Roti</label>
          <select name="jenis_roti" id="jenis" class="form-select" required>
            <option disabled>Pilih jenis Roti</option>
            <option value="Roti Manis" <?= ($roti['jenis_roti'] == 'Roti Manis') ? 'selected' : ''; ?>>Roti Manis</option>
            <option value="Roti Tawar" <?= ($roti['jenis_roti'] == 'Roti Tawar') ? 'selected' : ''; ?>>Roti Tawar</option>
            <option value="Roti Sobek" <?= ($roti['jenis_roti'] == 'Roti Sobek') ? 'selected' : ''; ?>>Roti Sobek</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label fw-bold">Harga</label>
          <input name="harga" type="number" class="form-control" id="harga" min="0" value="<?= $roti['harga']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Status Roti</label>
          <div class="d-flex gap-3">
             <div>
               <input id="tersedia" type="radio" name="status" value="Tersedia" <?= ($roti['status'] == 'Tersedia') ? 'checked' : ''; ?>>
               <label for="tersedia">Tersedia</label>
             </div>
             <div>
               <input id="habis" type="radio" name="status" value="Habis" <?= ($roti['status'] == 'Habis') ? 'checked' : ''; ?>>
               <label for="habis">Habis</label>
             </div>
          </div>
        </div>

        <div class="mb-4">
          <label for="gambar" class="form-label fw-bold">Gambar (Link URL)</label>
          <input name="gambar_url" type="text" class="form-control" id="gambar" value="<?= $roti['gambar_url']; ?>" required>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" name="update" class="btn btn-primary w-100 shadow-sm">Simpan Perubahan</button>
        </div>

      </form>
    </div>
  </main>

  <?php footer() ?>
</body>
</html>