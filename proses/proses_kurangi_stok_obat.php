<?php
include "connect.php";

$id_obat = (isset($_POST['id_obat'])) ? htmlentities($_POST['id_obat']) : "";
$jumlah_stok = (isset($_POST['jumlah_stok'])) ? htmlentities($_POST['jumlah_stok']) : "";

if (!empty($id_obat) && !empty($jumlah_stok)) {
    // Mengambil stok obat saat ini
    $query = mysqli_query($conn, "SELECT stok_obat FROM tb_daftar_obat WHERE id = '$id_obat'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $stok_obat = $data['stok_obat'];
        $stok_baru = $stok_obat - $jumlah_stok;

        // Cek apakah stok baru tidak negatif
        if ($stok_baru < 0) {
            $message = '<script>alert("Stok tidak bisa negatif"); window.location="../stok";</script>';
        } else {
            // Update stok obat di database
            $update_query = mysqli_query($conn, "UPDATE tb_daftar_obat SET stok_obat='$stok_baru' WHERE id='$id_obat'");

            if (!$update_query) {
                $message = '<script>alert("Stok gagal dikurangi"); window.location="../stok";</script>';
            } else {
                $message = '<script>alert("Stok berhasil dikurangi"); window.location="../stok";</script>';
            }
        }
    } else {
        $message = '<script>alert("Obat tidak ditemukan"); window.location="../stok";</script>';
    }
} else {
    $message = '<script>alert("Data tidak lengkap"); window.location="../stok";</script>';
}

echo $message;
?>
