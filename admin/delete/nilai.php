<?php
include("../../config.php");

$id = $_GET['id'];

// Delete record data dari id yang dikirim lewat url
$result = mysqli_query($mysqli, "DELETE FROM penilaian WHERE id_penilaian='$id'");

if ($result) {
    // redirection
    header("Location: ../nilai.php");
} else {
    echo "gagal hapus";
}
