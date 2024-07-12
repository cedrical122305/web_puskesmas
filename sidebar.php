<div class="col-lg-3">
                <nav class="navbar navbar-expand-lg bg-light rounded-3 border mt-2">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width:250px">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='home') || !isset($_GET['x']) ? 'active link-light' : 'link-dark' ;  ?>" aria-current="page" href="home"><i class="bi bi-houses-fill"></i> Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='stok') ? 'active link-light' : 'link-dark' ;   ?>" href="stok"><i class="bi bi-card-checklist"></i> Stok</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='transaksi') ? 'active link-light' : 'link-dark' ;   ?>" href="transaksi"><i class="bi bi-minecart-loaded"></i> Transaksi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='kadaluarsa') ? 'active link-light' : 'link-dark' ;   ?>" href="kadaluarsa"><i class="bi bi-stopwatch"></i> Kadaluarsa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='laporan') ? 'active link-light' : 'link-dark' ;   ?>" href="laporan"><i class="bi bi-files"></i> Laporan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>