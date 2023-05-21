<?php
include("../../config.php");

$id = $_GET['id'];

// Delete record data dari id yang dikirim lewat url
$result = mysqli_query($mysqli, "DELETE FROM mata_kuliah WHERE id_matakuliah='$id'");

if ($result) {
    // redirection
    header("Location: ../matakuliah.php");
} else {
    echo "gagal hapus";
}
