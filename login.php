<?php
require 'config/koneksi.php';
require 'components/components.php';

session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

$status = false; 
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        // Ambil datanya
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            // Set Session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;

            header("Location: index.php");
            exit;
        }
    }

    $status = true; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head("Halaman Login"); ?>
</head>

<body class="d-flex justify-content-center align-items-center mt-5">
  <section class="w-50 shadow-lg mt-5 p-4 rounded">
    <h1 class="text-center">Login Admin</h1>

    <?php
    if (function_exists('listAlert')) {
        listAlert($status);
    } elseif ($status) {
        echo "<div class='alert alert-danger'>Username atau Password salah!</div>";
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
        
        <button type="submit" class="btn btn-primary w-100" name="login" value="login">Masuk</button>
      </form>
      
      <a href="register.php">
          <button type="button" class="btn btn-outline-primary w-100 mt-3">Daftar Akun Baru</button>
      </a>
    </div>

  </section>

  <?php footer() ?>
</body>

</html>