<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_obat
    LEFT JOIN tb_kategori_obat ON tb_kategori_obat.id = tb_daftar_obat.kategori_obat
    LEFT JOIN tb_satuan_obat ON tb_satuan_obat.id = tb_daftar_obat.satuan
    LEFT JOIN tb_jenis_obat ON tb_jenis_obat.id = tb_daftar_obat.jenis_obat");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
$select_kat_obat = mysqli_query($conn, "SELECT id,kategori FROM tb_kategori_obat");
$select_jen_obat = mysqli_query($conn, "SELECT id,jenis FROM tb_jenis_obat");
$select_sat_obat = mysqli_query($conn, "SELECT id,satuan FROM tb_satuan_obat");
?>

<div class="col-lg-9 mt-2 mb-3">
    <div class="card">
        <div class="card-header">
            Daftar Obat
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn" style="background-color:green; color:yellow" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"><i class="bi bi-plus-square btn-sm"> </i>Tambah User</button>
                </div>
            </div>
            <!-- Awal Modal tambah Obat baru -->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Obat</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_obat.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control py-3" id="uploadFoto" placeholder="Your Name" name="foto" required>
                                            <label class="input-group-text" for="uploadFoto">Upload Foto Obat</label>
                                            <div class="invalid-feedback">
                                                Masukkan Foto
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Obat" name="nama_obat" required>
                                            <label for="floatingInput">Nama Obat</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Obat
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kat_obat" required>
                                                <option selected hidden value="">Pilih Kategori Obat</option>
                                                <?php
                                                foreach ($select_kat_obat as $value) {
                                                    echo "<option value=" . $value['id'] . ">$value[kategori]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Pilih Kategori Obat</label>
                                            <div class="invalid-feedback">
                                                Pilih Kategori
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="jen_obat" required>
                                                <option selected hidden value="">Pilih Jenis Obat</option>
                                                <?php
                                                foreach ($select_jen_obat as $value) {
                                                    echo "<option value=" . $value['id'] . ">$value[jenis]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Pilih Jenis Obat</label>
                                            <div class="invalid-feedback">
                                                Pilih jenis
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="sat_obat" required>
                                                <option selected hidden value="">Pilih Satuan Obat</option>
                                                <?php
                                                foreach ($select_sat_obat as $value) {
                                                    echo "<option value=" . $value['id'] . ">$value[satuan]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Pilih Satuan</label>
                                            <div class="invalid-feedback">
                                                Satuan Obat
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_obat_validate" value="12345">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Akhir Modal tambah obat baru -->
            <?php
            foreach ($result as $row) {
            ?>
                <!-- Awal Modal View -->
                <div class="modal fade" id="ModalView<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" value="<?php echo $row['nama'] ?>">
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username'] ?>">
                                                <label for="floatingInput">Username</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Username
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" aria-label="Default select example" required name="level">
                                                    <?php
                                                    $data = array("Admin/Owner", "Petugas");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo "<option selected value='" . ($key + 1) . "'>$value</option>";
                                                        } else {
                                                            echo "<option value='" . ($key + 1) . "'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Pilih Level User</label>
                                                <div class="invalid-feedback">
                                                    Pilih level user
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input disabled type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInput">No.HP</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nomer Handphone
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <textarea disabled class="form-control" id="" style="height: 100px;" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                        <div class="invalid-feedback">
                                            Masukkan Alamat
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal View -->

                <!-- Awal Modal Edit -->
                <div class="modal fade" id="ModalEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_user.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required value="<?php echo $row['nama'] ?>">
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input <?php echo ($row['username'] == $_SESSION['username_puskesmas']) ? 'disabled' : ''; ?> type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $row['username'] ?>">
                                                <label for="floatingInput">Username</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Username
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" required name="level" id="">
                                                    <?php
                                                    $data = array("Admin/Owner", "Petugas");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo "<option selected value='" . ($key + 1) . "'>$value</option>";
                                                        } else {
                                                            echo "<option value='" . ($key + 1) . "'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <label for="floatingInput">Pilih Level User</label>
                                                <div class="invalid-feedback">
                                                    Pilih level user
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInput">No.HP</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nomer Handphone
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" id="" style="height: 100px;" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                        <div class="invalid-feedback">
                                            Masukkan Alamat
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_user_validate" value="12345">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Edit -->

                <!-- Awal Modal Delete -->
                <div class="modal fade" id="ModalDelete<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_user.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_puskesmas']) {
                                            echo "<div class='alert alert-danger'> Anda tidak dapat menghapus akun sendiri</div>";
                                        } else {
                                            echo "Apakah anda yakin ingin menghapus user <b>$row[username]</b>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="input_user_validate" value="12345" <?php echo ($row['username'] == $_SESSION['username_puskesmas']) ? 'disabled' : ''; ?>>Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Delete -->

                <!-- Awal Modal Reset Password -->
                <div class="modal fade" id="ModalResetPassword<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_reset_password.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_puskesmas']) {
                                            echo "<div class='alert alert-danger'> Anda tidak dapat mereset password sendiri</div>";
                                        } else {
                                            echo "<div class='alert alert-warning'>Apakah anda yakin ingin mereset password user ini <b>$row[username]</b>menjadi password bawaan sistem yaitu <b>password</b></div>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="input_user_validate" value="12345" <?php echo ($row['username'] == $_SESSION['username_puskesmas']) ? 'disabled' : ''; ?>>Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Reset Password -->
            <?php
            }
            if (empty($result)) {
                echo "Data User tidak ada";
            } else {


            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowra">
                                <th scope="col">No</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Jenis Obat</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Satuan</th>
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
                                    <td><?php echo $row['jenis'] ?></td>
                                    <td><?php echo $row['kategori'] ?></td>
                                    <td><?php echo $row['satuan'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id']; ?>"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></button>
                                            <button class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalResetPassword<?php echo $row['id']; ?>"><i class="bi bi-arrow-clockwise"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>