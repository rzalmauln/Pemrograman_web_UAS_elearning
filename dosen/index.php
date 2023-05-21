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
    header("Location: ../login.php");
}

if (isset($_POST['edit'])) {
    $id_dosen = $_POST['id_dosen'];
    $nip = $_POST['nip'];
    $file = $_FILES['gambar'];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTemp = $file['tmp_name'];
    $fileSize = $file['size'];

    $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
    if (in_array($fileType, $allowedTypes)) {
        $uploadPath = '../img/' .  $nip . '_' . $fileName;
        if (move_uploaded_file($fileTemp, $uploadPath)) {
            $gambar = $nip . '_' . $fileName;

            $sql = "UPDATE dosen SET gambar='$gambar' WHERE id_dosen='$id_dosen'";
            $edit = mysqli_query($mysqli, $sql);
            header("Refresh:0");
        } else {
            $edit = 0;
        }
    } else {
        echo '<script>alert("data yang dikirim salah");</script>';
    }

    // $edit = mysqli_query($mysqli, "INSERT INTO dosen (gambar) VALUES ('$gambar') WHERE id_dosen='$id_dosen'");
    $edit = mysqli_query($mysqli, "UPDATE dosen SET gambar='$gambar' WHERE id_dosen='$id_dosen'");
    header("Refresh:0");
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-5 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-5 position-relative">
                                            <img style="object-fit:cover; object-position:center; height:180px; width:180px" src="../img/<?php echo $data_dosen['gambar'] ?>" class="img-thumbnail rounded-circle" alt="">
                                            <a href="" style="right:20px; bottom:0px;" data-toggle="modal" data-target="#editModal<?php echo $data_dosen["id_dosen"] ?>" class="position-absolute btn rounded-circle btn-sm btn-info text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="mt-2 " style="width: max-content;">
                                            <h1 class="h3 text-gray-800"><?php echo $data_dosen['nama_dosen'] ?></h1>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="">
                                            <h1 class="h4 text-gray-600"><?php echo $user['role'] ?></h1>
                                        </div>
                                    </div>
                                    <hr class="sidebar-diveder">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <h1 class="h6 text-gray-600">NIP</h1>
                                                <p class="mx-3"> : </p>
                                                <h1 class="h6 text-gray-600"><?php echo $data_dosen['nip'] ?></h1>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <h1 class="h6 text-gray-600">Email</h1>
                                                <p class="mx-3"> : </p>
                                                <h1 class="h6 text-gray-600"><?php echo $data_dosen['email_dosen'] ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <h1 class="h6 text-gray-600">Username</h1>
                                                <p class="mx-3"> : </p>
                                                <h1 class="h6 text-gray-600"><?php echo $user['username'] ?></h1>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <h1 class="h6 text-gray-600">Password</h1>
                                                <p class="mx-3"> : </p>
                                                <h1 class="h6 text-gray-600"><?php echo $user['password'] ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 mb-4" style="height: 500px;">
                            <div class="card border-left-primary shadow py-2 h-100">
                                <div class="card-body" style="max-height: max-content;">
                                    <h1 class="h3 mb-0 text-gray-800">Matkul yang diajar</h1>
                                    <hr class="sidebar-diveder">
                                    <div class="h-75" style="overflow:auto;">
                                        <?php
                                        $sql = "SELECT * FROM mata_kuliah INNER JOIN dosen ON mata_kuliah.id_dosen = dosen.id_dosen";
                                        $matakuliah_dosen = mysqli_query($mysqli, $sql);
                                        foreach ($matakuliah_dosen as $data) :
                                        ?>
                                            <div class="row no-gutters mb-3 align-items-center">
                                                <div class="card border-bottom-primary w-100 h-100 py-2">
                                                    <div class="card-body d-flex justify-content-between">
                                                        <h5 class=" mb-0 text-gray-800"> <?php echo $data['kd_matakuliah'] ?></h5>
                                                        <h5 class=" mb-0 text-gray-800"> <?php echo $data['nama_matakuliah'] ?></h5>
                                                        <h5 class=" mb-0 text-gray-800"> <?php echo $data['sks'] ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Edit Modal-->
                <div class="modal fade" id="editModal<?php echo $data_dosen["id_dosen"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                ?>
                                <form method="post" action="index.php" enctype="multipart/form-data">
                                    <div class="d-flex flex-column justify-content-center align-items-end p-4">
                                        <div class="mb-3 w-100">
                                            <div class="mb-2">
                                                <?php echo $data_dosen['gambar'] ?>
                                                <label for="formFile" class="form-label">Pilih foto</label>
                                                <div id="preview"></div>
                                                <input class="form-control" type="file" name="gambar" value="<?php echo $data_dosen['gambar'] ?>" id="formFile" required onchange="previewImage(event)">
                                                <div class="form-text" id="basic-addon4">Pilih foto (* jpg,jpeg,png,gif )</div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_dosen" value="<?php echo $data_dosen['id_dosen'] ?>">
                                        <input type="hidden" name="nip" value="<?php echo $data_dosen['nip'] ?>">
                                        <button type="submit" id="submit" name="edit" class="btn btn-outline-info">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


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
                    preview.style.width = "100px";
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