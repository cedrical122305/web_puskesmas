
            <?php 
            if (isset($_GET['x']) && $_GET['x']=='home') {
                $page ="home.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='stok') {
                $page ="stok.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='transaksi') {
                $page ="transaksi.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='laporan') {
                $page ="laporan.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='kadaluarsa') {
                $page ="kadaluarsa.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='login') {
                include "login.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='logout') {
                include "proses/proses_logout.php";
            }else {
                include "main.php";
            }
            ?>