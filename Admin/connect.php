<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "beautyskincare"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>