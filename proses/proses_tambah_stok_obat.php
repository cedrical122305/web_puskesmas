<?php
include "../proses/connect.php"; // Pastikan path ke connect.php sudah benar

// Mengecek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $id_obat = $_POST['id_obat'];
    $jumlah_stok = $_POST['jumlah_stok'];

    // Validasi input
    if (empty($id_obat) || empty($jumlah_stok) || !is_numeric($jumlah_stok) || $jumlah_stok <= 0) {
        die("Input tidak valid.");
    }

    // Mengambil stok lama dari tabel
    $query = mysqli_query($conn, "SELECT stok_obat FROM tb_daftar_obat WHERE id = $id_obat");
    if (!$query) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($query);
    if (!$row) {
        die("Obat tidak ditemukan.");
    }

    $stok_lama = $row['stok_obat'];

    // Menghitung stok baru
    $stok_baru = $stok_lama + $jumlah_stok;

    // Memperbarui stok obat
    $query_update = "UPDATE tb_daftar_obat SET stok_obat = $stok_baru WHERE id = $id_obat";
    if (mysqli_query($conn, $query_update)) {
        // Menyimpan riwayat transaksi stok dengan tanggal
        $tanggal_transaksi = date('Y-m-d'); // Mendapatkan tanggal dan waktu saat ini
        $query_riwayat = mysqli_query($conn, "INSERT INTO tb_riwayat_stok (id_obat, jumlah, jenis_transaksi, tanggal) VALUES ($id_obat, $jumlah_stok, 'tambah', '$tanggal_transaksi')");
        if ($query_riwayat) {
            echo "<script>alert('Stok berhasil ditambahkan.'); window.location.href='../stok';</script>";
        } else {
            echo "<script>alert('Stok berhasil diperbarui, tetapi gagal menyimpan riwayat stok.'); window.location.href='../stok';</script>";
        }
    } else {
        echo "<script>alert('Gagal menambahkan stok.'); window.location.href='../stok';</script>";
    }
} else {
    header("Location: ../stok");
}
?>
