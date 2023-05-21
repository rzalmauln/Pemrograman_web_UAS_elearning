<!-- Edit Modal-->
<div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        echo '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan <a class="link-underline-opacity-0" href="../admin/mahasiswa.php">View data</a> </div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> ' . mysqli_error($mysqli) . ' </div>';
                    }
                }
                $id = $row["id"];
                $edit = mysqli_query($mysqli, "SELECT * FROM kelas WHERE id='$id'");
                $data = mysqli_fetch_assoc($edit);
                ?>
                <form method="post" action="kelas.php" enctype="multipart/form-data">
                    <div class="d-flex flex-column justify-content-center align-items-center p-4">
                        <div class="mb-3 w-100">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <label for="floatingNRP">Kode kelas</label>
                                        <input type="text" name="kd_kelas" class="form-control" id="floatingNRP" required value="<?php echo $data['kd_kelas'] ?>" placeholder="kode kelas">
                                        <div class="form-text" id="basic-addon4">Masukkan Kode Kelas</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingNama">Nama Kelas</label>
                                        <input type="text" name="nama_kelas" class="form-control" id="floatingNama" required value="<?php echo $data['nama_kelas'] ?>" placeholder="nama kelas">
                                        <div class="form-text" id="basic-addon4">Masukkan Nama Kelas</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                            <button type="submit" id="submit" name="edit" class="btn btn-outline-info" style="width: max-content;">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>