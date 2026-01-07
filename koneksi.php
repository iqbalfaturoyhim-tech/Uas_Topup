<?php
$conn = mysqli_connect(
  "localhost",
  "root",
  "",
  "uas_topup"   // NAMA DATABASE KAMU
);

if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
