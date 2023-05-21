<?php
include("../../config.php");

$id = $_GET['id'];

// Delete record data dari id yang dikirim lewat url
$result = mysqli_query($mysqli, "DELETE FROM kelas WHERE kd_kelas='$id'");

if ($result) {
    // redirection
    header("Location: ../kelas.php");
} else {
    echo "gagal hapus";
}
