<?php
include "../config/koneksi.php";

if (isset($_GET['id'])) {
    
    $id = $_GET['id'];

    $query = "DELETE FROM roti WHERE id_roti = '$id'";

    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data!');
            document.location.href = '../index.php';
        </script>";
    }

} else {
    header("Location: ../index.php");
    exit;
}

mysqli_close($koneksi);
?>