<?php
    //session_start();
    if(empty($_SESSION['username_puskesmas'])){
        header('location:login');
    }
    include "proses/connect.php";
    $username = $_SESSION['username_puskesmas'];
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

    $hasil = mysqli_fetch_array($query);

    
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Puskesmas-mengatur,dan melihat stok obat</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    
    <!--header-->
    <?php include("header.php"); ?>
    <!--end header-->
    <div class="container-lg">
        <div class="row mb-5">
            <!--sidebar-->
            <?php include("sidebar.php"); ?>
            <!--end sidebar-->

            <!--content-->
            <?php 
                include $page;
            ?>
            <!--end content-->
        </div>
        <div class="fixed-bottom text-center py-2" style="background-color: #C8E6C9;">
            kucinghitam2024-cape:)
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
</body>

</html>