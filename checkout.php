<?php
$harga = $_POST['produk'];
$jumlah = $_POST['jumlah'];
$total = $harga * $jumlah;

echo "<h2>Total Bayar: Rp $total</h2>";
?>
