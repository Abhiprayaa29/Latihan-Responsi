<?php
include "../config/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "UPDATE roti SET status = 'Habis' WHERE id_roti = '$id'";
    
    mysqli_query($koneksi, $query);
    

    header("Location: ../detail.php?id=$id");
    exit;
} else {
    header("Location: ../index.php");
}
?>