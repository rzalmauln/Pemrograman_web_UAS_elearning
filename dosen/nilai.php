<?php
include("../config.php");
session_start();
if ($_SESSION["status"] == 'login') {
    $tampil = 1;
    $username = $_SESSION["username"];
    $rslt = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($rslt);
    $dosen = mysqli_query($mysqli, "SELECT * FROM dosen WHERE id_users = '$user[id_users]'");
    $data_dosen = mysqli_fetch_assoc($dosen);
} else {
    header("Location: ./login.php");
}

if (isset($_POST['submit'])) {
    $id_matakuliah = $_POST['matakuliah'];
    $id_kelas = $_POST['kelas'];

    $sql = "SELECT * FROM penilaian INNER JOIN mahasiswa ON penilaian.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN mata_kuliah ON penilaian.id_matakuliah = mata_kuliah.id_matakuliah INNER JOIN dosen ON mata_kuliah.id_dosen = dosen.id_dosen WHERE mata_kuliah.id_matakuliah='$id_matakuliah' and mahasiswa.id_kelas='$id_kelas'";
    $nilai = mysqli_query($mysqli, $sql);
    // $data_nilai = mysqli_fetch_assoc($nilai);
}

if (isset($_POST['save'])) {
    $nilai = $_POST['nilai'];
    $save = mysqli_query($mysqli, "UPDATE penilaian SET nilai='$nilai'");

    $sql = "SELECT * FROM penilaian INNER JOIN mahasiswa ON penilaian.id_mahasiswa = mahasiswa.id_mahasiswa INNER JOIN mata_kuliah ON penilaian.id_matakuliah = mata_kuliah.id_matakuliah INNER JOIN dosen ON mata_kuliah.id_dosen = dosen.id_dosen ";
    $nilai = mysqli_query($mysqli, $sql);
    echo '<script>alert("data yang dikirim berhasil");</script>';
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
                                            <option>Matkul</option>
                                            <?php
                                            $matakuliah = mysqli_query($mysqli, "SELECT * FROM mata_kuliah");
                                            while ($mtklh = mysqli_fetch_assoc($matakuliah)) {
                                                echo '<option value="' . $mtklh["id_matakuliah"] . '">' . $mtklh["nama_matakuliah"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="form-text" id="basic-addon4">Pilih matakuliah</div>
                                    </div>
                                    <div class="col form-floating">
                                        <label for="floatingEmail">Kelas</label>
                                        <select class="form-select" name="kelas" aria-label="Default select example">
                                            <option>Kelas</option>
                                            <?php
                                            $kelas = mysqli_query($mysqli, "SELECT * FROM kelas");
                                            while ($kls = mysqli_fetch_assoc($kelas)) {
                                                echo '<option value="' . $kls["id_kelas"] . '">' . $kls["nama_kelas"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="form-text" id="basic-addon4">Pilih kelas</div>
                                    </div>
                                    <button type="submit" id="submit" name="submit" class="col-1 btn btn-outline-info" style="height: max-content;">Cari</button>
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
                                            <th>Nilai</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($nilai as $row) : ?>
                                            <tr>
                                                <form action="" method="post">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["nrp"]; ?></td>
                                                    <td><?php echo $row["nama_mahasiswa"]; ?></td>
                                                    <td><?php echo $row["nama_matakuliah"]; ?></td>
                                                    <td><?php echo $row["nama_dosen"]; ?></td>
                                                    <td><?php echo $row["sks"]; ?></td>
                                                    <td>
                                                        <input type="number" class="w-25" name="nilai" id="" value="<?php echo $row["nilai"]; ?>">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" type="submit" name="save"><i class="fas fa-save"></i></button> |
                                                        <a href="./delete/nilai.php?id=<?php echo $row["id_penilaian"] ?>" class="btn btn-sm btn-danger" onclick=" return confirm(' Anda yakin ingin menghapusnya')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </form>
                                            </tr>
                                            <?php include('../components/edit_modal_matakuliah.php') ?>
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