<!-- Edit Modal-->
<div class="modal fade" id="editModal<?php echo $row["id_dosen"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                $id = $row["id_dosen"];
                $edit = mysqli_query($mysqli, "SELECT * FROM dosen INNER JOIN users ON dosen.id_users = users.id_users WHERE id_dosen='$id'");
                $data = mysqli_fetch_assoc($edit);
                ?>
                <form method="post" action="dosen.php" enctype="multipart/form-data">
                    <div class="d-flex flex-column justify-content-center align-items-center p-4">
                        <div class="mb-3 w-100">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <label for="floatingNRP">NIP</label>
                                        <input type="text" name="nip" class="form-control" id="floatingNRP" required value="<?php echo $data['nip'] ?>" placeholder="nrp">
                                        <div class="form-text" id="basic-addon4">Masukkan NRP</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingNama">Nama</label>
                                        <input type="text" name="nama_dosen" class="form-control" id="floatingNama" required value="<?php echo $data['nama_dosen'] ?>" placeholder="nama">
                                        <div class="form-text" id="basic-addon4">Masukkan nama</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingEmail">Email</label>
                                        <input type="email" name="email_dosen" class="form-control" id="floatingEmail" required value="<?php echo $data['email_dosen'] ?>" placeholder="email">
                                        <div class="form-text" id="basic-addon4">Masukkan email</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <label for="floatingPassword">Username</label>
                                        <input type="text" name="username" class="form-control" id="floatingPassword" value="<?php echo $data['username'] ?>" placeholder="Password">
                                        <div class="form-text" id="basic-addon4">Masukkan password</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="floatingPassword">Password</label>
                                        <input type="text" name="password" class="form-control" id="floatingPassword" value="<?php echo $data['password'] ?>" placeholder="Password">
                                        <div class="form-text" id="basic-addon4">Masukkan password</div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="formFile" class="form-label">Pilih foto</label>
                                        <div id="preview"></div>
                                        <input class="form-control" required type="file" value="<?php echo $data['gambar'] ?>" name="gambar" id="formFile" onchange="previewImage(event)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_users" value="<?php echo $data['id_users'] ?>">
                        <button type="submit" id="submit" name="edit" class="btn btn-outline-info" style="width: max-content;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var img = document.createElement("img");
            img.src = reader.result;
            img.style.width = "100%";
            var preview = document.getElementById("preview");
            preview.style.width = "30px";
            preview.style.height = "40px";
            preview.style.overflow = "hidden";
            preview.innerHTML = "";
            preview.appendChild(img);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>