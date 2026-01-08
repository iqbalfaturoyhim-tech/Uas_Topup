<?php
include "../koneksi.php";

$nama = $_POST['nama_produk'];
$game = $_POST['game'];
$harga = $_POST['harga'];

mysqli_query($conn, "INSERT INTO produk VALUES ('','$nama','$game','$harga')");

header("Location: produk.php");
