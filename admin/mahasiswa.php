<?php
include("../config.php");
session_start();
if ($_SESSION["status"] == 'login') {
    $tampil = 1;
    $username = $_SESSION["username"];
    $rslt = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($rslt);
    $data = mysqli_query($mysqli, "SELECT * FROM mahasiswa INNER JOIN kelas ON mahasiswa.id_kelas = kelas.id_kelas INNER JOIN users ON mahasiswa.id_users = users.id_users ORDER BY nrp ASC");
} else {
    header("Location: ../login.php");
}

if (isset($_POST['edit'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $id_users = $_POST['id_users'];
    $id_kelas = $_POST['kelas'];
    $nrp = $_POST['nrp'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $email_mahasiswa = $_POST['email_mahasiswa'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $file = $_FILES['gambar'];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTemp = $file['tmp_name'];
    $fileSize = $file['size'];

    $sql = "UPDATE users SET username='$username',password='$password' WHERE id_users='$id_users'";
    $edit = mysqli_query($mysqli, $sql);

    $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

    if (in_array($fileType, $allowedTypes)) {
        $uploadPath = '../img/' .  $nrp . '_' . $fileName;
        if (move_uploaded_file($fileTemp, $uploadPath)) {
            $gambar = $nrp . '_' . $fileName;

            $sql = "UPDATE mahasiswa SET id_users='$id_users',id_kelas='$id_kelas',nrp='$nrp',nama_mahasiswa='$nama_mahasiswa',email_mahasiswa='$email_mahasiswa',gambar='$gambar' WHERE id_users='$id_users'";
            $edit = mysqli_query($mysqli, $sql);
            header("Refresh:0");
        } else {
            $edit = 0;
        }
    } else {
        echo '<script>alert("data yang dikirim salah");</script>';
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

                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="overflow-auto position-relative" style="height: 350px;">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="position-sticky top-0 bg-white">
                                        <tr>
                                            <th>No</th>
                                            <th>NRP</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Kelas</th>
                                            <th>Foto</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $row) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["nrp"]; ?></td>
                                                <td><?php echo $row["nama_mahasiswa"]; ?></td>
                                                <td><?php echo $row["email_mahasiswa"]; ?></td>
                                                <td><?php echo $row["username"]; ?></td>
                                                <td><?php echo $row["password"]; ?></td>
                                                <td><?php echo $row["nama_kelas"]; ?></td>
                                                <td class="align-middle">
                                                    <div class="mx-auto" style="width: 64px; height: 64px; overflow: hidden;">
                                                        <img class="w-100 h-100" style="object-fit: cover; object-position: center;" src="../img/<?php echo $row["gambar"]; ?>" alt="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#editModal<?php echo $row["id_mahasiswa"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg>
                                                    </a> |
                                                    <a href="./delete/mahasiswa.php?id=<?php echo $row["nrp"] ?>" class="btn btn-sm btn-danger" onclick=" return confirm(' Anda yakin ingin menghapusnya')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                        </svg>
                                                    </a> |
                                                    <a href="../img/<?php echo $row["gambar"] ?>" class="btn btn-sm btn-warning" download="<?php echo $row["gambar"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php include('../components/edit_modal_mahasiswa.php') ?>
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