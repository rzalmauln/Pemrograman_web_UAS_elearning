<?php
include("../config.php");
session_start();
if ($_SESSION["status"] == 'login') {
    $tampil = 1;
    $username = $_SESSION["username"];
    $rslt = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($rslt);
} else {
    header("Location: ../login.php");
}

if (isset($_POST['submit'])) {
    include("config.php");

    $kd_kelas = $_POST['kd_kelas'];
    $nama_kelas = $_POST['nama_kelas'];

    $sql = "INSERT INTO kelas (kd_kelas, nama_kelas) 
                    VALUES ('$kd_kelas','$nama_kelas')";
    $result = mysqli_query($mysqli, $sql);
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
                            <h6 class="m-0 font-weight-bold text-primary">Inputkan Data Kelas</h6>
                        </div>
                        <div class="card-body">
                            <form class="glass col-12 d-flex flex-column justify-content-center align-items-center p-4" method="post" action="add_kelas.php" enctype="multipart/form-data">
                                <?php
                                if (isset($_POST['submit'])) {
                                    if ($result === "Data yang dikirim salah") {
                                        echo '<div class="alert alert-danger" role="alert"> Data yang dikirim salah </div>';
                                    } elseif ($result) {
                                        echo '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan <a class="link-underline-opacity-0" href="kelas.php">View data</a> </div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert"> ' . mysqli_error($mysqli) . ' </div>';
                                    }
                                }
                                ?>
                                <div class="mb-3 w-100">
                                    <div class="row">
                                        <div class="col form-floating mb-3">
                                            <label for="floatingNRP">Kode Kelas</label>
                                            <input type="text" name="kd_kelas" class="form-control" id="floatingNRP" required placeholder="1000A">
                                            <div class="form-text" id="basic-addon4">Masukkan Kode Kelas</div>
                                        </div>
                                        <div class="col form-floating mb-3">
                                            <label for="floatingNama">Nama Kelas</label>
                                            <input type="text" name="nama_kelas" class="form-control" id="floatingNama" required placeholder="1 D4 IT A">
                                            <div class="form-text" id="basic-addon4">Masukkan Nama Kelas</div>
                                        </div>
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
</body>

</html>