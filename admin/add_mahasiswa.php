<?php
include("../config.php");
session_start();
if ($_SESSION["status"] == 'login') {
    $tampil = 1;
    $username = $_SESSION["username"];
    $rslt = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($rslt);
} else {
    header("Location: ./login.php");
}

if (isset($_POST['submit'])) {
    include("config.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    // $id_users = $_POST['users'];
    $id_kelas = $_POST['kelas'];
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $file = $_FILES['gambar'];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTemp = $file['tmp_name'];
    $fileSize = $file['size'];

    $result = mysqli_query($mysqli, "INSERT INTO users (username,password,role) VALUE('$username','$password','mahasiswa')");
    $users = mysqli_query($mysqli, "SELECT MAX(id_users) AS id_users FROM users LIMIT 1");
    $data = mysqli_fetch_array($users);
    $id_users = $data['id_users'];

    $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

    if (in_array($fileType, $allowedTypes)) {
        $uploadPath = '../img/' .  $nrp . '_' . $fileName;
        if (move_uploaded_file($fileTemp, $uploadPath)) {
            $image = $nrp . '_' . $fileName;
            $sql = "INSERT INTO mahasiswa (id_users,id_kelas,nrp,nama_mahasiswa,email_mahasiswa,gambar) 
                    VALUES ('$id_users','$id_kelas','$nrp','$nama','$email','$image')";
            $result = mysqli_query($mysqli, $sql);
        }
    } else {
        echo "Eror";
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<?php include('../layouts/head.php') ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('../components/sidebar.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('../components/topbar.php') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Inputkan Data Mahasiswa</h6>
                        </div>
                        <div class="card-body">
                            <form class="glass col-12 d-flex flex-column justify-content-center align-items-center p-4" method="post" action="add_mahasiswa.php" enctype="multipart/form-data">
                                <?php
                                if (isset($_POST['submit'])) {
                                    if ($result === "Data yang dikirim salah") {
                                        echo '<div class="alert alert-danger" role="alert"> Data yang dikirim salah </div>';
                                    } elseif ($result) {
                                        echo '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan <a class="link-underline-opacity-0" href="mahasiswa.php">View data</a> </div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert"> ' . mysqli_error($mysqli) . ' </div>';
                                    }
                                }
                                ?>
                                <div class="mb-3 w-100">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <label for="floatingNRP">NRP</label>
                                                <input type="text" name="nrp" class="form-control" id="floatingNRP" required placeholder="nrp">
                                                <div class="form-text" id="basic-addon4">Masukkan NRP</div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingNama">Nama</label>
                                                <input type="text" name="nama" class="form-control" id="floatingNama" required placeholder="nama">
                                                <div class="form-text" id="basic-addon4">Masukkan nama</div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <label for="floatingEmail">Email</label>
                                                <input type="email" name="email" class="form-control" id="floatingEmail" required placeholder="email">
                                                <div class="form-text" id="basic-addon4">Masukkan email</div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingEmail">Kelas</label>
                                                <select class="form-select" name="kelas" aria-label="Default select example">
                                                    <?php
                                                    $kelas = mysqli_query($mysqli, "SELECT * FROM kelas");
                                                    while ($kls = mysqli_fetch_assoc($kelas)) {
                                                        echo '<option value="' . $kls["id_kelas"] . '">' . $kls["nama_kelas"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div class="form-text" id="basic-addon4">Pilih kelas</div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <label for="floatingEmail">username</label>
                                                <input type="text" name="username" class="form-control" id="floatingEmail" required placeholder="username">
                                                <div class="form-text" id="basic-addon4">Masukkan username</div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingEmail">password</label>
                                                <input type="text" name="password" class="form-control" id="floatingEmail" required placeholder="password">
                                                <div class="form-text" id="basic-addon4">Masukkan password</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="formFile" class="form-label">Foto</label>
                                        <div id="preview"></div>
                                        <input class="form-control" type="file" name="gambar" id="formFile" onchange="previewImage(event)">
                                        <div class="form-text" id="basic-addon4">Pilih foto (* jpg,jpeg,png,gif )</div>
                                    </div>
                                </div>
                                <button type="submit" id="submit" name="submit" class="btn btn-outline-info" style="width: max-content;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <?php include('../components/footer.php') ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include('../components/logout.php') ?>

    <?php include('../layouts/script.php') ?>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var img = document.createElement("img");
                img.src = reader.result;
                img.style.width = "100%";
                var preview = document.getElementById("preview");
                preview.style.width = "200px";
                preview.style.height = "100px";
                preview.style.overflow = "hidden";
                preview.innerHTML = "";
                preview.appendChild(img);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>