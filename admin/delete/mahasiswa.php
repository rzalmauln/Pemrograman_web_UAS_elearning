<?php
include("../../config.php");

$id = $_GET['id'];

// Delete record data dari id yang dikirim lewat url
$result = mysqli_query($mysqli, "DELETE FROM mahasiswa WHERE nrp='$id'");

if ($result) {
    // redirection
    header("Location: ../mahasiswa.php");
} else {
    echo "gagal hapus";
}
