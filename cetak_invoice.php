<?php
session_start();
include "koneksi.php";

if (!isset($_GET['invoice'])) {
  die("Invoice tidak ditemukan");
}

$invoice = $_GET['invoice'];
$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE invoice='$invoice'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cetak Invoice</title>
  <style>
    body { font-family: Arial; }
    .box {
      width: 700px;
      margin: auto;
      border: 1px solid #000;
      padding: 20px;
    }
    table {
      width: 100%;
    }
    td {
      padding: 6px;
    }
  </style>
</head>

<body onload="window.print()">

<div class="box">
  <h2 align="center">INVOICE RIXXIE STORE</h2>
  <hr>

  <table>
    <tr><td>Invoice</td><td>: <b><?= $row['invoice']; ?></b></td></tr>
    <tr><td>User</td><td>: <?= $row['username']; ?></td></tr>
    <tr><td>Produk</td><td>: <?= $row['produk']; ?></td></tr>
    <tr><td>ID Game</td><td>: <?= $row['id_game']; ?></td></tr>
    <tr><td>ID Server</td><td>: <?= $row['id_server']; ?></td></tr>
    <tr><td>Username Game</td><td>: <?= $row['username_game']; ?></td></tr>
    <tr><td>Pembayaran</td><td>: <?= $row['pembayaran_via']; ?></td></tr>
    <tr><td>Voucher</td><td>: <?= $row['voucher'] ?: '-'; ?></td></tr>
    <tr><td>Total</td><td>: <b>Rp <?= number_format($row['total']); ?></b></td></tr>
    <tr><td>Status</td><td>: <?= $row['status']; ?></td></tr>
  </table>

  <hr>
  <p align="center">Terima kasih telah bertransaksi</p>
</div>

</body>
</html>
