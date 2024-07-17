<?php
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama_obat = (isset($_POST['nama_obat'])) ? htmlentities($_POST['nama_obat']) : "";
$kat_obat = (isset($_POST['kat_obat'])) ? htmlentities($_POST['kat_obat']) : "";
$jen_obat = (isset($_POST['jen_obat'])) ? htmlentities($_POST['jen_obat']) : "";
$sat_obat = (isset($_POST['sat_obat'])) ? htmlentities($_POST['sat_obat']) : "";


$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (!empty($_POST['input_obat_validate'])) {
    //cek apakah gambar atau bukan
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "maaf, File yang dimasukkan telah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['foto']['size'] > 500000) { //500kb
                $message = "file yang diupload terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imageType != "jpg" && $imageType != "png" && $imageType != "gif" && $imageType != "jpeg") {
                    $message = "maaf, gambar/foto dapat diinput hanya dengan format JPG, JPEG, PNG, GIF";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ' Gambar tidak dapat diupload"); 
                window.location="../obat"</script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_daftar_obat WHERE nama_obat = '$nama_obat'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("Nama obat yang dimasukkan telah ada");
                    window.location="../obat"</script>';
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, "UPDATE tb_daftar_obat SET 
    foto='" . $kode_rand . $_FILES['foto']['name'] . "', 
    nama_obat='$nama_obat', 
    kategori_obat='$kat_obat', 
    jenis_obat='$jen_obat', 
    satuan_obat='$sat_obat' 
    WHERE id='$id'");

                if ($query) {
                    $message = '<script>alert("Data berhasil dimasukkan");
                        window.location="../obat"</script>';
                } else {
                    $message = '<script>alert("Data gagal dimasukkan");
                        window.location="../obat"</script>';
                }
            } else {
                $message = '<script>alert("Maaf, terjadi kesalahan File tidak dapat diupload");
                        window.location="../obat"</script>';
            }
        }
    }
}
echo $message;
