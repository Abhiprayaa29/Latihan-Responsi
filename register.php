<?php
require 'config/koneksi.php';
require 'components/components.php';

$status = 0;

if (isset($_POST["register"])) {
    // Ambil data dari form dan bersihkan
    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
    $konfirmasi = mysqli_real_escape_string($koneksi, $_POST["konfirmasi_password"]);

    $cek_username = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
        $status = 0;
    } else {
        if ($password !== $konfirmasi) {
            echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
            $status = 0; // Gagal
        } else {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')";
            
            mysqli_query($koneksi, $query);

            if (mysqli_affected_rows($koneksi) > 0) {
                echo "<script>
                        alert('User baru berhasil ditambahkan!');
                        document.location.href = 'login.php';
                      </script>";
                $status = 1;
            } else {
                echo "<script>alert('Gagal menambahkan user!');</script>";
                $status = 0;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head("Halaman Register"); ?>
</head>

<body class="d-flex justify-content-center align-items-center mt-5">
  <section class="w-50 shadow-lg mt-5 p-4 rounded">

    <h1 class="text-center">Register Admin</h1>

    <?php
    if(isset($status)) {
        listAlert($status);
    }
    ?>

    <div class="card-body">
      <form action="logic/auth.logic.php" method="post">
        
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div class="mb-3">
          <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
        </div>
        
        <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
      </form>
      
      <a href="login.php">
          <button type="button" class="btn btn-outline-primary w-100 mt-3">Menuju ke Login</button>
      </a>
    </div>

  </section>

  <?php footer() ?>
</body>

</html>