<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT tb_daftar_obat.*, tb_satuan_obat.satuan 
    FROM tb_daftar_obat 
    LEFT JOIN tb_satuan_obat ON tb_satuan_obat.id_sat_obat = tb_daftar_obat.satuan_obat");

$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (mysqli_num_rows($query) > 0) {
?>

    <div class="col-lg-9 mt-2 mb-3">
        <div class="card">
            <div class="card-header">
                <b>Laporan Stok Obat Puskesmas</b>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <!-- Tambahkan fitur pencarian di sini -->
                </div>
                <!-- Awal Modal Laporan Harian Stok Obat -->
                <!-- Awal Modal Laporan Harian Stok Obat -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalLaporanHarian<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Laporan Harian Stok Obat - <?php echo $row['nama_obat']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    // Query untuk laporan harian
                                    $id_obat = $row['id'];
                                    $date_today = date('Y-m-d');
                                    $query_harian = mysqli_query($conn, "SELECT * FROM tb_riwayat_stok WHERE id_obat = $id_obat AND tanggal = '$date_today'");

                                    if (mysqli_num_rows($query_harian) > 0) {
                                    ?>
                                        <table class="table table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Jenis Transaksi</th>
                                                    <th scope="col">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($row_harian = mysqli_fetch_assoc($query_harian)) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $no++; ?></th>
                                                        <td><?php echo $row_harian['jumlah']; ?></td>
                                                        <td><?php echo $row_harian['jenis_transaksi']; ?></td>
                                                        <td><?php echo $row_harian['tanggal']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p>Tidak ada transaksi hari ini.</p>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Laporan Harian Stok Obat -->

                <!-- Akhir Modal Laporan Harian Stok  obat -->

                <!-- Awal Modal Laporan Mingguan Stok Obat -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalLaporanMingguan<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Laporan Mingguan Stok Obat - <?php echo $row['nama_obat']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    // Query untuk laporan mingguan
                                    $id_obat = $row['id'];
                                    $date_one_week_ago = date('Y-m-d', strtotime('-1 week'));
                                    $query_mingguan = mysqli_query($conn, "SELECT * FROM tb_riwayat_stok WHERE id_obat = $id_obat AND tanggal >= '$date_one_week_ago'");

                                    if (mysqli_num_rows($query_mingguan) > 0) {
                                    ?>
                                        <table class="table table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Jenis Transaksi</th>
                                                    <th scope="col">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($row_mingguan = mysqli_fetch_assoc($query_mingguan)) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $no++; ?></th>
                                                        <td><?php echo $row_mingguan['jumlah']; ?></td>
                                                        <td><?php echo $row_mingguan['jenis_transaksi']; ?></td>
                                                        <td><?php echo $row_mingguan['tanggal']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p>Tidak ada transaksi dalam minggu ini.</p>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Laporan Mingguan Stok Obat -->


                <!-- Awal Modal Laporan Bulanan Stok Obat -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalLaporanBulanan<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Laporan Bulanan Stok Obat - <?php echo $row['nama_obat']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    // Query untuk laporan bulanan
                                    $id_obat = $row['id'];
                                    $date_one_month_ago = date('Y-m-d', strtotime('-1 month'));
                                    $query_bulanan = mysqli_query($conn, "SELECT * FROM tb_riwayat_stok WHERE id_obat = $id_obat AND tanggal >= '$date_one_month_ago'");

                                    if (mysqli_num_rows($query_bulanan) > 0) {
                                    ?>
                                        <table class="table table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Jenis Transaksi</th>
                                                    <th scope="col">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($row_bulanan = mysqli_fetch_assoc($query_bulanan)) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $no++; ?></th>
                                                        <td><?php echo $row_bulanan['jumlah']; ?></td>
                                                        <td><?php echo $row_bulanan['jenis_transaksi']; ?></td>
                                                        <td><?php echo $row_bulanan['tanggal']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p>Tidak ada transaksi bulan ini.</p>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Laporan Bulanan Stok Obat -->


                <?php if (empty($result)) { ?>
                    <p>Obat Tidak tersedia</p>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr class="text-nowrap">
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Stok Masuk</th>
                                    <th scope="col">Stok Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td>
                                            <div style="width: 100px;">
                                                <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="...">
                                            </div>
                                        </td>
                                        <td><?php echo $row['nama_obat'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['stok_obat'] == 0) {
                                                echo "-";
                                            } else {
                                                echo $row['stok_obat'] . ' ' . $row['satuan'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalLaporanHarian<?php echo $row['id']; ?>">Harian</button>
                                                <button class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalLaporanMingguan<?php echo $row['id']; ?>">Mingguan</button>
                                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalLaporanBulanan<?php echo $row['id']; ?>">Bulanan</button>

                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
} else {
    echo "Tidak ada obat yang tersedia.";
}
?>