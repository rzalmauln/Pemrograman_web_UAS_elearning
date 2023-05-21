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

if (isset($_POST['submit'])) {
    $id_matakuliah = $_POST['matakuliah'];
    $id_mahasiswa = $_POST['id_mahasiswa'];

    $sql = "INSERT INTO penilaian (id_matakuliah,id_mahasiswa)  VALUES ('$id_matakuliah','$id_mahasiswa')";
    $penilaian = mysqli_query($mysqli, $sql);
    // $data_nilai = mysqli_fetch_assoc($nilai);
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">

                                <div class="row align-items-center">
                                    <div class="col form-floating">
                                        <label for="floatingEmail">Matakuliah</label>
                                        <select class="form-select" name="matakuliah" aria-label="Default select example">
                                            <?php
                                            $matakuliah = mysqli_query($mysqli, "SELECT * FROM mata_kuliah INNER JOIN dosen ON mata_kuliah.id_dosen = dosen.id_dosen");
                                            while ($mtklh = mysqli_fetch_assoc($matakuliah)) {
                                                echo '<option value="' . $mtklh["id_matakuliah"] . '">' . $mtklh["nama_matakuliah"] . ' - ' . $mtklh["nama_dosen"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="form-text" id="basic-addon4">Pilih matakuliah</div>
                                    </div>
                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $data_mahasiswa['id_mahasiswa'] ?>">
                                    <button type="submit" id="submit" name="submit" class="col-3 btn btn-outline-info" style="height: max-content;">Tambah</button>
                                </div>

                            </form>
                            <div class="overflow-auto position-relative mt-5" style="height: 350px;">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="position-sticky top-0 bg-white">
                                        <tr>
                                            <th>No</th>
                                            <th>NRP</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Nama Matakuliah</th>
                                            <th>Pengajar</th>
                                            <th>SKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($nilai as $row) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["nrp"]; ?></td>
                                                <td><?php echo $row["nama_mahasiswa"]; ?></td>
                                                <td><?php echo $row["nama_matakuliah"]; ?></td>
                                                <td><?php echo $row["nama_dosen"]; ?></td>
                                                <td><?php echo $row["sks"]; ?></td>
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