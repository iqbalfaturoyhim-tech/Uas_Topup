<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// LOGIN ADMIN
if ($username == "admin" && $password == "admin123") {
    $_SESSION['username'] = "admin";
    $_SESSION['role'] = "admin";
    header("Location: dashboard.php");
    exit;
}

// LOGIN PEMBELI (CEK DATABASE)
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = "user";
    header("Location: dashboard.php");
} else {
    echo "<script>
        alert('Username atau Password salah!');
        window.location='login.php';
    </script>";
}
