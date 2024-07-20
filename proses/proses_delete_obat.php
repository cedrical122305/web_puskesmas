<?php
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";

if (!empty($_POST['input_user_validate'])) {
    // Hapus data terkait dari tb_riwayat_stok
    $deleteRiwayat = mysqli_query($conn, "DELETE FROM tb_riwayat_stok WHERE id_obat='$id'");
    
    if ($deleteRiwayat) {
        // Hapus data dari tb_daftar_obat
        $query = mysqli_query($conn, "DELETE FROM tb_daftar_obat WHERE id='$id'");
        if ($query) {
            // Jika penghapusan data berhasil, hapus file foto
            $fotoPath = "../assets/img/$foto";
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
            $message = '<script>alert("Data berhasil dihapus");
                        window.location="../obat"</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus");
                        window.location="../obat"</script>';
        }
    } else {
        $message = '<script>alert("Gagal menghapus data riwayat stok");
                    window.location="../obat"</script>';
    }
}
echo $message;
?>
