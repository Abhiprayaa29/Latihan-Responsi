<?php
include "../config/koneksi.php";

if (isset($_POST['update'])) {

    $id         = $_POST['id'];
    $nama_roti  = htmlspecialchars($_POST['nama_roti']);
    $jenis_roti = htmlspecialchars($_POST['jenis_roti']);
    $harga      = htmlspecialchars($_POST['harga']);
    $status     = htmlspecialchars($_POST['status']);
    $gambar_url = htmlspecialchars($_POST['gambar_url']);

    $sql = "UPDATE roti SET 
                nama_roti = '$nama_roti', 
                jenis_roti = '$jenis_roti', 
                harga = '$harga', 
                status = '$status', 
                gambar_url = '$gambar_url' 
            WHERE id_roti = $id";

    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        echo "<script>
            alert('Data roti berhasil diupdate!');
            document.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mengupdate data!');
            document.location.href = '../update.php?id=$id';
        </script>";
    }

} else {
    header("Location: ../index.php");
    exit;
}

mysqli_close($koneksi);
?>