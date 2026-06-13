<?php
include 'connect.php';
/* =========================
   UPDATE CATEGORY (EDIT)
========================= */
if(isset($_POST['update'])){
    $id = $_POST['id_kategori'];
    $nama = $_POST['nama_kategori'];
    $update = mysqli_query($conn, "
        UPDATE kategori 
        SET nama_kategori='$nama' 
        WHERE id_kategori='$id'
    ");
    if(!$update){
        die("Gagal update: " . mysqli_error($conn));
    } else {
    header("Location: kategori.php"); 
    exit; 
}
}

/* =========================
   AMBIL DATA KATEGORI
========================= */
$query = mysqli_query($conn, "SELECT * FROM kategori");

if(!$query){
    die("Error Query Kategori: " . mysqli_error($conn));
}

$totalKategori = mysqli_num_rows($query);


/* =========================
   DELETE CATEGORY
========================= */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete = mysqli_query($conn, "
        DELETE FROM kategori 
        WHERE id_kategori='$id'
    ");

    if(!$delete){
        die("Gagal hapus: " . mysqli_error($conn));
    } else {
        header("Location: kategori.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Categories - BeautySkincare</title>
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
        <li>
            <a href="dashboard.php">Dashboard</a>
        </li>

        <li>
            <a href="produk.php">Products</a>
        </li>

        <li class="active">
            <a href="kategori.php">Categories</a>
        </li>
    </ul>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

</div>

<!-- Main Content -->
<div class="main">

    <div class="navbar">
        <h1>Categories</h1>
        <span>Total Categories: <?= $totalKategori; ?></span>
    </div>

    <div class="content">

        <div class="header-action">

            <button type="button" class="btn" onclick="openModal()">
                + Add Category
            </button>

        </div>

        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th width="220">Action</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($query)){ ?>

                <tr>

                    <td><?= $row['id_kategori']; ?></td>

                    <td><?= $row['nama_kategori']; ?></td>

                    <td class="action-buttons">

                        <button 
                            class="btn-edit"
                            onclick="openEditModal('<?= $row['id_kategori']; ?>','<?= $row['nama_kategori']; ?>')">
                            Edit
                        </button>

                        <a
                            href="?delete=<?= $row['id_kategori']; ?>"
                            class="btn-delete"
                            onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="modalKategori" class="modal">
    <div class="modal-box">
        <h2>Add Category</h2>
        <form action="simpan_kategori.php" method="POST">
            <label>Nama Kategori</label>
            <input
                type="text"
                name="nama_kategori"
                placeholder="Contoh: Essence"
                required>

            <div class="modal-action">
                <button type="submit" class="btn">
                    Save
                </button>

                <button
                    type="button"
                    class="btn-delete"
                    onclick="closeModal()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT HARUS DI SINI -->
<script>
function openModal() {
    document.getElementById("modalKategori").style.display = "flex";
}
function closeModal() {
    document.getElementById("modalKategori").style.display = "none";
}
window.onclick = function(event){
    let modal = document.getElementById("modalKategori");
    if(event.target == modal){
        modal.style.display = "none";
    }
}
</script>

<!-- EDIT MODAL -->
<div id="modalEditKategori" class="modal">
    <div class="modal-box">
        <h2>Edit Category</h2>
        <form method="POST">
            <input type="hidden" name="id_kategori" id="edit_id">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" id="edit_nama" required>
            <div class="modal-action">
                <button type="submit" name="update" class="btn">
                    Update
                </button>
                <button type="button" class="btn-delete" onclick="closeEditModal()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>

function openModal() {
    document.getElementById("modalKategori").style.display = "flex";
}

function closeModal() {
    document.getElementById("modalKategori").style.display = "none";
}

function openEditModal(id, nama){
    document.getElementById("modalEditKategori").style.display = "flex";
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_nama").value = nama;
}
function closeEditModal(){
    document.getElementById("modalEditKategori").style.display = "none";
}

window.onclick = function(event){
    let modal1 = document.getElementById("modalKategori");
    let modal2 = document.getElementById("modalEditKategori");

    if(event.target == modal1){
        modal1.style.display = "none";
    }
    if(event.target == modal2){
        modal2.style.display = "none";
    }
}
</script>

</body>
</html>