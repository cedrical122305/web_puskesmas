<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT tb_daftar_obat.*, tb_satuan_obat.satuan 
    FROM tb_daftar_obat 
    LEFT JOIN tb_satuan_obat ON tb_satuan_obat.id_sat_obat = tb_daftar_obat.satuan_obat");

$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="col-lg-9 mt-2 mb-3">
    <div class="card">
        <div class="card-header">
            <b>Stok Obat</b>
        </div>
        <div class="card-body">
            <?php if (empty($result)) { ?>
                <p>Obat Tidak tersedia</p>
            <?php } else { ?>
                <div class="row mb-3">
                    <!-- Tambahkan fitur pencarian di sini -->
                </div>
                <!-- Awal Modal Tambah Stok Obat -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalTambahStok<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Obat - <?php echo $row['nama_obat']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="needs-validation" novalidate action="proses/proses_tambah_stok_obat.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_obat" value="<?php echo $row['id']; ?>">
                                        <div class="mb-3">
                                            <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                                            <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Tambah Stok Obat -->

                <!-- Awal Modal Kurangi Stok Obat -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalKurangiStok<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kurangi Stok Obat - <?php echo $row['nama_obat']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="needs-validation" novalidate action="proses/proses_kurangi_stok_obat.php" method="POST" enctype="application/x-www-form-urlencoded">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_obat" value="<?php echo $row['id']; ?>">
                                        <div class="mb-3">
                                            <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                                            <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Kurangi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Kurangi Stok Obat -->

                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Stok Obat</th>
                                <th scope="col">Stok Masuk</th>
                                <th scope="col">Stok Keluar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                $id_obat = $row['id'];
                                $query_stok_masuk = mysqli_query($conn, "SELECT SUM(jumlah) AS total_masuk FROM tb_riwayat_stok WHERE id_obat = $id_obat AND jenis_transaksi = 'tambah'");
                                $stok_masuk = mysqli_fetch_assoc($query_stok_masuk)['total_masuk'] ?? 0;
                                $query_stok_keluar = mysqli_query($conn, "SELECT SUM(jumlah) AS total_keluar FROM tb_riwayat_stok WHERE id_obat = $id_obat AND jenis_transaksi = 'kurangi'");
                                $stok_keluar = mysqli_fetch_assoc($query_stok_keluar)['total_keluar'] ?? 0;
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td>
                                        <div style="width: 100px;">
                                            <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="...">
                                        </div>
                                    </td>
                                    <td><?php echo $row['nama_obat'] ?></td>
                                    <td><?php echo $row['stok_obat'] . ' ' . $row['satuan']; ?></td>
                                    <td><?php echo $stok_masuk . ' ' . $row['satuan']; ?></td>
                                    <td><?php echo $stok_keluar . ' ' . $row['satuan']; ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalTambahStok<?php echo $row['id']; ?>"><i class="bi bi-plus-circle"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalKurangiStok<?php echo $row['id']; ?>"><i class="bi bi-dash-circle"></i></button>
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
