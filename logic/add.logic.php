<?php
include "../config/koneksi.php";

// LOGIKA KAMU
if (isset($_POST['tambah'])) {
    $nama_roti  = htmlspecialchars($_POST['nama_roti']);
    $jenis_roti = htmlspecialchars($_POST['jenis_roti']);
    $harga      = htmlspecialchars($_POST['harga']);
    $gambar_url = htmlspecialchars($_POST['gambar_url']);

    $status = "Tersedia";

    if (empty($gambar_url)) {
        $gambar_url = "https://placehold.co/600x400?text=Gambar+Kosong";
    }

    $query = "INSERT INTO roti (nama_roti, jenis_roti, harga, status, gambar_url) 
              VALUES ('$nama_roti', '$jenis_roti', '$harga', '$status', '$gambar_url')";

    $result = mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = '../index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data!');
                document.location.href = '../tambah.php';
              </script>";
    }

} else {
    // Jika file ini diakses langsung tanpa menekan tombol tambah
    header("Location: ../tambah.php");
    exit;
}

mysqli_close($koneksi);
?>