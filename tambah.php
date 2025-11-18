<?php
require 'config/koneksi.php';
require 'components/components.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["tambah"])) {
    $nama_roti  = htmlspecialchars($_POST["nama_roti"]);
    $jenis_roti = htmlspecialchars($_POST["jenis_roti"]);
    $harga      = htmlspecialchars($_POST["harga"]);
    $gambar_url = htmlspecialchars($_POST["gambar_url"]);
    
    $status = "Tersedia";

    if (empty($gambar_url)) {
        $gambar_url = "https://placehold.co/600x400?text=Foto+Kosong";
    }

    $query = "INSERT INTO roti (nama_roti, jenis_roti, harga, status, gambar_url) 
              VALUES ('$nama_roti', '$jenis_roti', '$harga', '$status', '$gambar_url')";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head><?= head("Tambah Data Roti"); ?></head>
<body>
  <?php navbar() ?>

  <main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Tambah Data Menu Roti Baru</h2>
    </div>

    <div class="card p-4 shadow-sm">
      <form action="logic/add.logic.php" method="post">
        <div class="mb-3">
          <label for="nama" class="form-label fw-bold">Nama Roti</label>
          <input name="nama_roti" type="text" class="form-control" id="nama" placeholder="Contoh: Croissant" required>
        </div>

        <div class="mb-3">
          <label for="jenis" class="form-label fw-bold">Jenis Roti</label>
          <select name="jenis_roti" id="jenis" class="form-select" required>
            <option selected disabled value="">Pilih jenis roti</option>
            <option value="Roti Manis">Roti Manis</option>
            <option value="Roti Tawar">Roti Tawar</option>
            <option value="Roti Sobek">Roti Sobek</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label fw-bold">Harga Roti (Rp)</label>
          <input name="harga" type="number" class="form-control" id="harga" placeholder="Harga Roti, Contoh: 10000" min="0" required>
        </div>

        <div class="mb-4">
          <label for="gambar" class="form-label fw-bold">Gambar (Link URL)</label>
          <input name="gambar_url" type="text" class="form-control" id="gambar" placeholder="Link Gambar Roti (Unsplash disarankan)">
          <div class="form-text">Biarkan kosong untuk menggunakan gambar default.</div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" name="tambah" class="btn btn-primary w-100 shadow-sm">Simpan Data</button>
          <button type="reset" class="btn btn-outline-secondary w-25">Reset</button>
        </div>
      </form>
    </div>
  </main>

  <?php footer() ?>
</body>
</html>