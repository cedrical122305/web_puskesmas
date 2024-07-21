<?php
include "../proses/connect.php"; // Pastikan path ke connect.php sudah benar

// Mengecek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $id_obat = $_POST['id_obat'];
    $jumlah_stok = $_POST['jumlah_stok'];

    // Validasi input
    if (empty($id_obat) || empty($jumlah_stok) || !is_numeric($jumlah_stok) || $jumlah_stok <= 0) {
        echo "<script>alert('Input tidak valid.'); window.location.href='../stok';</script>";
        exit();
    }

    // Mengambil stok lama dari tabel
    $query = mysqli_query($conn, "SELECT stok_obat FROM tb_daftar_obat WHERE id = $id_obat");
    if (!$query) {
        echo "<script>alert('Query gagal: " . mysqli_error($conn) . "'); window.location.href='../stok';</script>";
        exit();
    }

    $row = mysqli_fetch_assoc($query);
    if (!$row) {
        echo "<script>alert('Obat tidak ditemukan.'); window.location.href='../stok';</script>";
        exit();
    }

    $stok_lama = $row['stok_obat'];

    // Mengecek apakah stok mencukupi untuk dikurangi
    if ($jumlah_stok > $stok_lama) {
        echo "<script>alert('Jumlah stok yang dikurangi melebihi stok yang tersedia.'); window.location.href='../stok';</script>";
        exit();
    }

    // Menghitung stok baru
    $stok_baru = $stok_lama - $jumlah_stok;

    // Memperbarui stok obat
    $query_update = mysqli_query($conn, "UPDATE tb_daftar_obat SET stok_obat = $stok_baru WHERE id = $id_obat");
    if (!$query_update) {
        echo "<script>alert('Gagal memperbarui stok: " . mysqli_error($conn) . "'); window.location.href='../stok';</script>";
        exit();
    }

    // Menyimpan riwayat transaksi stok
    $tanggal_transaksi = date('Y-m-d'); // Mendapatkan tanggal dan waktu saat ini
    $query_riwayat = mysqli_query($conn, "INSERT INTO tb_riwayat_stok (id_obat, jumlah, jenis_transaksi, tanggal) VALUES ($id_obat, $jumlah_stok, 'kurangi', '$tanggal_transaksi')");

    if ($query_riwayat) {
        echo "<script>alert('Stok berhasil dikurangi.'); window.location.href='../stok';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan riwayat stok: " . mysqli_error($conn) . "'); window.location.href='../stok';</script>";
    }
} else {
    header("Location: ../stok");
    exit();
}
