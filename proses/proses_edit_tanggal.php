<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_obat = $_POST['id_obat'];
    $tanggal_produksi = $_POST['tanggal_produksi'];
    $tanggal_expired = $_POST['tanggal_expired'];

    $query = "UPDATE tb_daftar_obat 
            SET tanggal_produksi = '$tanggal_produksi', tanggal_expired = '$tanggal_expired'
            WHERE id = '$id_obat'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tanggal produksi dan expired berhasil diperbarui.'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui tanggal.'); window.location.href='../index.php';</script>";
    }
} else {
    header("Location: ../index.php");
}
?>
