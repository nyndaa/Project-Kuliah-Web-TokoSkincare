<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
include 'connect.php';
$resultProduk = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
if(!$resultProduk){
    die("ERROR PRODUK: " . mysqli_error($conn));
}
$produk = mysqli_fetch_assoc($resultProduk)['total'];

$resultKategori = mysqli_query($conn, "SELECT COUNT(*) as total FROM kategori");
if(!$resultKategori){
    die("ERROR KATEGORI: " . mysqli_error($conn));
}

$kategori = mysqli_fetch_assoc($resultKategori)['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - BeautySkincare</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <h2>BeautySkincare</h2>
        <p>Admin Panel</p>
    </div>

    <ul>
        <li class="active"><a href="dashboard.php">Dashboard</a></li>
        <li><a href="produk.php">Products</a></li>
        <li><a href="kategori.php">Categories</a></li>
    </ul>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

</div>


<!-- MAIN -->
<div class="main">

    <div class="navbar">
        <h1>Dashboard</h1>
    </div>

    <div class="content">

        <!-- HEADER DASHBOARD -->
        <div class="hero">
            <div class="hero-content">
                <h2>
                    Selamat Datang Di Dashboard Admin 
                    <span class="brand">BeautySkincare</span>
                </h2>
                <p>Kelola dan pantau seluruh data BeautySkincare dalam satu dashboard terpusat.</p>
            </div>
        </div>

        <!-- STATS -->
        <div class="stats">

            <div class="card">
                <h3>Total Produk</h3>
                <p><?= $produk; ?></p>
            </div>

            <div class="card">
                <h3>Total Kategori</h3>
                <p><?= $kategori; ?></p>
            </div>

        </div>

        <!-- ACTION MENU -->
        <div class="menu">

            <a href="produk.php" class="menu-card">
                📦 Kelola Produk
            </a>

            <a href="kategori.php" class="menu-card">
                📁 Kelola Kategori
            </a>

        </div>

    </div>

</div>

</body>
</html>