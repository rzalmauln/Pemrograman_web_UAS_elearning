<?php
include("../config.php");
session_start();
if ($_SESSION["status"] == 'login') {
    $tampil = 1;
    $username = $_SESSION["username"];
    $rslt = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($rslt);
    $mahasiswa = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE id_users = '$user[id_users]'");
    $data_mahasiswa = mysqli_fetch_assoc($mahasiswa);
} else {
    header("Location: ./login.php");
}

$sql = "SELECT * FROM penilaian INNER JOIN mahasiswa ON penilaian.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN mata_kuliah ON penilaian.id_matakuliah = mata_kuliah.id_matakuliah INNER JOIN dosen ON mata_kuliah.id_dosen = dosen.id_dosen ";
$nilai = mysqli_query($mysqli, $sql);

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

                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Matakuliah dan Nilai</h6>
                        </div>
                        <div class="card-body">
                            <div class="overflow-auto position-relative" style="height: 350px;">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="position-sticky top-0 bg-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Matakuliah</th>
                                            <th>Nama Matakuliah</th>
                                            <th>SKS</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($nilai as $row) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["kd_matakuliah"]; ?></td>
                                                <td><?php echo $row["nama_matakuliah"]; ?></td>
                                                <td><?php echo $row["sks"]; ?></td>
                                                <td><?php echo $row["nilai"]; ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
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