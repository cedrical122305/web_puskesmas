<?php
    $conn = mysqli_connect("localhost","root","","web_puskesmas");
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    
?>