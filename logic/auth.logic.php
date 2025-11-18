<?php
session_start();
include "../config/koneksi.php";

// 1. LOGIKA REGISTER
if (isset($_POST['register'])) {
    // Ambil data dan amankan karakter
    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
    $konfirmasi = mysqli_real_escape_string($koneksi, $_POST["konfirmasi_password"]);

    $cek_user = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    
    if (mysqli_fetch_assoc($cek_user)) {
        echo "<script>
                alert('Username sudah terdaftar!');
                document.location.href = '../register.php';
              </script>";
        return false;
    }

    // Cek konfirmasi password
    if ($password !== $konfirmasi) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
                document.location.href = '../register.php';
              </script>";
        return false;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')";
    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>
                alert('Registrasi Berhasil! Silakan Login.');
                document.location.href = '../login.php';
              </script>";
    } else {
        echo "<script>
                alert('Registrasi Gagal!');
                document.location.href = '../register.php';
              </script>";
    }
}

// 2. LOGIKA LOGIN
elseif (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        // Ambil data user
        $row = mysqli_fetch_assoc($result);
        
        // Cek Password (Verify Hash)
        if (password_verify($password, $row["password"])) {
            // Set Session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["id_user"] = $row["id_user"];

            // Redirect ke Index
            header("Location: ../index.php");
            exit;
        }
    }
    echo "<script>
            alert('Username atau Password salah!');
            document.location.href = '../login.php';
          </script>";
}
// 3. LOGIKA LOGOUT
elseif (isset($_POST['logout'])) {
    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: ../login.php");
    exit;
}

mysqli_close($koneksi);
?>