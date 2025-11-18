<?php
// NOTE : 
// JIKA TIDAK PAHAM, BUAT LANGSUNG DI FILE TAMPILAN AJA

function head($title)
{
?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title) ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <link rel="stylesheet" href="css/style.css">
<?php
}
?>

<?php
function footer()
{ ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
  <script>
    if (window.location.search.includes("status=")) {
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  </script>
<?php }
?>

<?php
function alert($type, $message)
{ ?>
  <div class="px-2 pt-2">
    <div class="alert alert-<?= $type ?> m-0 shadow-sm alert-dismissible fade show" role="alert">
      <?= $message ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
<?php } ?>

<?php
function listAlert($status)
{
  // ALERT STATUS TAMPIL
  // (Pastikan logic/auth.logic.php mengirim ?status=... jika ingin fitur ini jalan)
  if (!$status) return; // Jika status kosong, jangan lakukan apa-apa

  switch ($status) {
    case "berhasil":
      alert("success", "Berhasil! Silahkan lanjutkan.");
      break;
    case "gagal_password":
      alert("danger", "Error: Konfirmasi Password tidak sama");
      break;
    case "duplikat":
      alert("danger", "Error: Username sudah terdaftar");
      break;
    case "username_tidak_ditemukan":
      alert("danger", "Error: Akun user tidak ditemukan");
      break;
    case "password_salah":
      alert("danger", "Error: Password salah / User tidak ditemukan");
      break;
    case "gagal":
      alert("danger", "Error: Terjadi Kesalahan Sistem");
      break;
    default:
      break;
  }
}
?>

<?php
// Fungsi Card Menu yang sudah diisi Kode Kamu
function cardMenu($data)
{
?>
  <div class="card h-100 shadow-sm" style="max-width: 300px;">
    <img src="<?= $data['gambar_url']; ?>" class="card-img-top object-cover" alt="<?= $data['nama_roti']; ?>" style="height: 200px; object-fit: cover;">
    
    <div class="card-body d-flex flex-column">
      <h5 class="card-title"><?= $data['nama_roti']; ?></h5>
      
      <p class="card-text m-0 text-muted small"><?= $data['jenis_roti']; ?></p>
      
      <p class="card-text m-0 mb-3">Rp <span class="fw-bold"><?= number_format($data['harga'], 0, ',', '.'); ?></span></p>

      <div class="mt-auto">
        <div class="d-flex gap-2 mb-2">
          <a href="update.php?id=<?= $data['id_roti']; ?>" class="btn btn-warning btn-sm w-100 text-white">Edit</a>
          
          <a href="logic/delete.logic.php?id=<?= $data['id_roti']; ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin ingin menghapus <?= $data['nama_roti']; ?>?')">Hapus</a>
        </div>
        
        <a href="detail.php?id=<?= $data['id_roti']; ?>" class="btn btn-primary w-100">Lihat Detail</a>
      </div>
    </div>
  </div>
<?php
}
?>

<?php
function navbar()
{
?>
  <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="index.php">🍞 Bakery Bliss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           </ul>
        
        <form action="logic/auth.logic.php" method="post" class="d-flex">
          <button class="btn btn-outline-danger" type="submit" name="logout">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
      </div>
    </div>
  </nav>
<?php
}
?>