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
            <b>Stok Obat</b>
        </div>
        <div class="card-body">
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
            <!-- Akhir Modal Tambah stok obat -->

            <!-- Awal Modal Kurangi stok obat -->
            <?php foreach ($result as $row) { ?>
                <div class="modal fade" id="ModalKurangiStok<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kurangi Stok Obat - <?php echo $row['nama_obat']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="needs-validation" novalidate action="proses/proses_kurangi_stok_obat.php" method="POST" enctype="multipart/form-data">
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
            <!-- Akhir Modal kurangi stok obat -->

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
                                <th scope="col">Stok Obat</th>
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
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalKurangiStok<?php echo $row['id']; ?>"><i class="bi bi-trash"></i> Kurangi Stok</button>
                                            <button class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalTambahStok<?php echo $row['id']; ?>"><i class="bi bi-plus"></i> Tambah Stok</button>
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
