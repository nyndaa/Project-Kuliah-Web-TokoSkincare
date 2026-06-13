<?php
include 'connect.php';
$query = mysqli_query($conn, "
    SELECT
        produk.*,
        kategori.nama_kategori
    FROM produk
    JOIN kategori
        ON produk.id_kategori = kategori.id_kategori
");

if(!$query){
    die("Error Query: " . mysqli_error($conn));
}

$totalProduk = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products - BeautySkincare</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <h2>BeautySkincare</h2>
        <p>Admin Panel</p>
    </div>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li class="active"><a href="produk.php">Products</a></li>
        <li><a href="kategori.php">Categories</a></li>
    </ul>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

</div>

<!-- MAIN -->
<div class="main">
    <div class="navbar">
        <h1>Products</h1>
        <span>Total Products: <?= $totalProduk; ?></span>
    </div>

    <div class="content">
        <!-- ADD BUTTON -->
        <div class="header-action">
            <a href="#" class="btn" onclick="openModal()">
                + Add Product
            </a>
        </div>

        <!-- TABLE -->
        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($query)){ ?>

                <tr>

                    <td><?= $row['id_produk']; ?></td>

                    <td>
                        <img src="../images/<?= $row['gambar']; ?>" class="product-img">
                    </td>

                    <td><?= $row['nama_produk']; ?></td>
                    <td><?= $row['merk']; ?></td>

                    <td>
                        Rp <?= number_format($row['harga'],0,',','.'); ?>
                    </td>

                    <td><?= $row['stok']; ?></td>

                    <td><?= $row['nama_kategori']; ?></td>

                    <td class="action-buttons">

                        <a href="edit_produk.php?id=<?= $row['id_produk']; ?>" class="btn-edit">
                            Edit
                        </a>

                        <a href="hapus_produk.php?id=<?= $row['id_produk']; ?>"
                           class="btn-delete"
                           onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div id="modalProduct" class="modal">

    <div class="modal-box">

        <h2>Add Product</h2>

       <form action="simpan_produk.php" method="POST" enctype="multipart/form-data">
            <label>Gambar Produk</label>
            <input type="file" name="gambar" required>
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" required>
            <label>Merk</label>
            <input type="text" name="merk" required>
            <label>Harga</label>
            <input type="number" name="harga" required>
            <label>Stok</label>
            <input type="number" name="stok" required>
            <label>Kategori</label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                while($k = mysqli_fetch_assoc($kategori)){
                ?>
                    <option value="<?= $k['id_kategori']; ?>">
                        <?= $k['nama_kategori']; ?>
                    </option>
                <?php } ?>
            </select>

            <div class="modal-action">
                <button type="submit" class="btn">
                    Save
                </button>
                <button type="button" class="btn-delete" onclick="closeModal()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>


<script>
function openModal(){
    document.getElementById("modalProduct").style.display = "flex";
}
function closeModal(){
    document.getElementById("modalProduct").style.display = "none";
}
window.onclick = function(event){
    let modal = document.getElementById("modalProduct");

    if(event.target == modal){
        modal.style.display = "none";
    }
}
</script>
</body>
</html>