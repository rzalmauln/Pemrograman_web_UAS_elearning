<?php
include("../../config.php");

$id = $_GET['id'];

// Delete record data dari id yang dikirim lewat url
$result = mysqli_query($mysqli, "DELETE FROM dosen WHERE nip='$id'");

if ($result) {
    // redirection
    header("Location: ../dosen.php");
} else {
    echo "gagal hapus";
}
