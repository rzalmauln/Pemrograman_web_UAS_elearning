<!-- Edit Modal-->
<div class="modal fade" id="editModal<?php echo $row["id_matakuliah"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-end">
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body p-3">
                <!-- Basic Card Example -->
                <?php
                if (isset($_POST['edit'])) {
                    if ($edit) {
                        echo '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan <a class="link-underline-opacity-0" href="../admin/matakuliah.php">View data</a> </div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> ' . mysqli_error($mysqli) . ' </div>';
                    }
                }
                $id = $row["id_matakuliah"];
                $edit = mysqli_query($mysqli, "SELECT * FROM mata_kuliah INNER JOIN dosen ON mata_kuliah.id_dosen = dosen.id_dosen WHERE id_matakuliah='$id'");
                $data = mysqli_fetch_assoc($edit);
                ?>
                <form method="post" action="matakuliah.php" enctype="multipart/form-data">
                    <div class="d-flex flex-column justify-content-center align-items-center p-4">
                        <div class="mb-3 w-100">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <label for="floatingNRP">Kode matakuliah</label>
                                        <input type="text" name="kd_matakuliah" class="form-control" id="floatingNRP" required value="<?php echo $data['kd_matakuliah'] ?>" placeholder="kode matakuliah">
                                        <div class="form-text" id="basic-addon4">Masukkan Kode matakuliah</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingNama">Nama matakuliah</label>
                                        <input type="text" name="nama_matakuliah" class="form-control" id="floatingNama" required value="<?php echo $data['nama_matakuliah'] ?>" placeholder="nama matakuliah">
                                        <div class="form-text" id="basic-addon4">Masukkan Nama matakuliha</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <?php if ($user['role'] == 'admin') : ?>
                                            <label for="floatingEmail">Pengajar</label>
                                            <select class="form-select" name="dosen" aria-label="Default select example">
                                                <option value="<?php echo $data['id_dosen'] ?>"><?php echo $data['nama_dosen'] ?></option>
                                                <?php
                                                $dosen = mysqli_query($mysqli, "SELECT * FROM dosen");
                                                while ($dsn = mysqli_fetch_assoc($dosen)) {
                                                    echo '<option value="' . $dsn["id_dosen"] . '">' . $dsn["nama_dosen"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div class="form-text" id="basic-addon4">Pilih Dosen</div>
                                        <?php elseif ($user['role'] == 'dosen') : ?>
                                            <label for="floatingEmail">Pengajar</label>
                                            <?php
                                            $dosen = mysqli_query($mysqli, "SELECT * FROM dosen WHERE id_dosen=$user[id_users]");
                                            while ($dsn = mysqli_fetch_assoc($dosen)) {
                                                echo '<input type="text"  disabled class="form-control" id="floatingNama" required placeholder="' . $dsn['nama_dosen'] . '">';
                                                echo '<input type="hidden" name="dosen" value="' . $dsn['id_dosen'] . '" class="form-control" id="floatingNama">';
                                            }
                                            ?>
                                            <div class="form-text" id="basic-addon4">Pilih Dosen</div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingNama">Jumlah SKS</label>
                                        <input type="text" name="sks" class="form-control" id="floatingNama" required value="<?php echo $data['sks'] ?>" placeholder="sks">
                                        <div class="form-text" id="basic-addon4">Masukkan Jumlah SKS</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_matakuliah" value="<?php echo $data['id_matakuliah'] ?>">
                            <button type="submit" id="submit" name="edit" class="btn btn-outline-info" style="width: max-content;">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>