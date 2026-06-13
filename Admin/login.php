<?php
session_start();
include 'connect.php';

$error = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if($data){
        $_SESSION['admin'] = $data['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin - BeautySkincare</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="login-container">

    <form method="POST" class="login-box">

        <h2>Login Admin</h2>
        <p>BeautySkincare Dashboard</p>

        <?php if($error != "") { ?>
            <div class="error"><?= $error; ?></div>
        <?php } ?>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

    </form>

</div>

</body>
</html>