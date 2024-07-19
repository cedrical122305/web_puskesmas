<?php
include "connect.php";

function updateStatus($conn) {
    // Ambil semua obat dari tb_daftar_obat
    $query = mysqli_query($conn, "SELECT id, nama_obat, tanggal_expired FROM tb_daftar_obat");
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
    foreach ($result as $row) {
        $id_obat = $row['id'];
        $tanggal_expired = $row['tanggal_expired'];
        $status = "";

        if (!is_null($tanggal_expired)) {
            $date_now = new DateTime();
            $date_expired = new DateTime($tanggal_expired);
            $interval = $date_now->diff($date_expired)->days;

            if ($date_now > $date_expired) {
                $status = "kadaluarsa";
            } elseif ($interval <= 15) {
                $status = "mendekati";
            } else {
                $status = "aman";
            }
        } else {
            // Tanggal expired tidak ada, bisa atur status default
            $status = "tidak diketahui";
        }

        // Periksa apakah status sudah ada di tabel tb_status
        $check_status_query = mysqli_query($conn, "SELECT * FROM tb_status WHERE id_obat = '$id_obat'");
        if (mysqli_num_rows($check_status_query) > 0) {
            // Perbarui status
            $update_status_query = "UPDATE tb_status SET status = '$status' WHERE id_obat = '$id_obat'";
            mysqli_query($conn, $update_status_query);
        } else {
            // Tambahkan status baru
            $insert_status_query = "INSERT INTO tb_status (id_obat, status) VALUES ('$id_obat', '$status')";
            mysqli_query($conn, $insert_status_query);
        }
    }
}

// Panggil fungsi untuk memperbarui status
updateStatus($conn);
?>
