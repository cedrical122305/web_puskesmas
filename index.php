
            <?php 
            session_start();
            if (isset($_GET['x']) && $_GET['x']=='home') {
                $page ="home.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='stok') {
                $page ="stok.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='user') {
                if($_SESSION['level_puskesmas']==1){
                $page ="user.php";
                include "main.php";
                }else{
                    $page = "home.php";
                    include "main.php";
                }
            }elseif (isset($_GET['x']) && $_GET['x']=='laporan') {
                $page ="laporan.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='kadaluarsa') {
                $page ="kadaluarsa.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='obat') {
                $page ="obat.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='login') {
                include "login.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='logout') {
                include "proses/proses_logout.php";
            }else {
                $page = "home.php";
                include "main.php";
            }
            ?>