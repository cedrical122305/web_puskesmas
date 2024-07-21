<?php
include "proses/connect.php";
include "proses/update_status.php";

// Panggil fungsi untuk memperbarui status
updateStatus($conn);

$query = mysqli_query($conn, "SELECT tb_daftar_obat.id, tb_daftar_obat.nama_obat, tb_daftar_obat.foto, tb_daftar_obat.tanggal_produksi, tb_daftar_obat.tanggal_expired, tb_status.status
    FROM tb_daftar_obat
    LEFT JOIN tb_status ON tb_daftar_obat.id = tb_status.id_obat");

$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="col-lg-9 mt-2 mb-3">
    <div class="card">
        <div class="card-header">
            <b>Kadaluarsa Obat</b>
        </div>
        <div class="card-body">
            <?php if (empty($result)) { ?>
                <p>Obat Tidak tersedia</p>
            <?php } else { ?>
                <div class="row mb-3">
                    <!-- Tambahkan fitur pencarian di sini -->
                </div>

                <!-- Awal Modal Tambah tanggal produksi dan tanggal expired Obat -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalTambahTanggalProduksiExpired<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tanggal Produksi dan Expired - <?php echo htmlspecialchars($row['nama_obat']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="needs-validation" novalidate action="proses/proses_tambah_tanggal.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_obat" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <div class="mb-3">
                                            <label for="tanggal_produksi" class="form-label">Tanggal Produksi</label>
                                            <input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_expired" class="form-label">Tanggal Expired</label>
                                            <input type="date" class="form-control" id="tanggal_expired" name="tanggal_expired" required>
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
                <!-- Akhir Modal Tambah tanggal produksi dan tanggal expired obat -->

                <!-- Awal Modal Edit tanggal produksi dan tanggal expired obat -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalEditTanggalProduksiExpired<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Tanggal Produksi dan Expired - <?php echo htmlspecialchars($row['nama_obat']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="needs-validation" novalidate action="proses/proses_edit_tanggal.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_obat" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <div class="mb-3">
                                            <label for="tanggal_produksi" class="form-label">Tanggal Produksi</label>
                                            <input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="<?php echo htmlspecialchars($row['tanggal_produksi']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_expired" class="form-label">Tanggal Expired</label>
                                            <input type="date" class="form-control" id="tanggal_expired" name="tanggal_expired" value="<?php echo htmlspecialchars($row['tanggal_expired']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Edit tanggal produksi dan tanggal expired obat -->

                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Tgl Produksi</th>
                                <th scope="col">Tgl Expired</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
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
                                            <img src="assets/img/<?php echo htmlspecialchars($row['foto']); ?>" class="img-thumbnail" alt="<?php echo htmlspecialchars($row['nama_obat']); ?>">
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['nama_obat']); ?></td>
                                    <td><?php echo !empty($row['tanggal_produksi']) ? htmlspecialchars($row['tanggal_produksi']) : 'Tidak Diketahui'; ?></td>
                                    <td><?php echo !empty($row['tanggal_expired']) ? htmlspecialchars($row['tanggal_expired']) : 'Tidak Diketahui'; ?></td>

                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalTambahTanggalProduksiExpired<?php echo $row['id']; ?>"><i class="bi bi-calendar-plus"></i> Catat Tanggal</button>
                                            <button class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEditTanggalProduksiExpired<?php echo $row['id']; ?>"><i class="bi bi-calendar-range"></i> Edit Tanggal</button>
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
