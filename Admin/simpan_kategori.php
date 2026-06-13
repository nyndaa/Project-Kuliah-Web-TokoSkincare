<?php
include 'connect.php';

$nama = $_POST['nama_kategori'];

mysqli_query($conn, "
    INSERT INTO kategori (nama_kategori)
    VALUES ('$nama')
");

header("Location: kategori.php");
exit;
?>