<?php
session_start();
include "../koneksi.php";

if ($_SESSION['role'] != 'admin') {
  header("Location: ../dashboard.php");
  exit;
}

// FILTER TANGGAL
$where = "";
if (isset($_GET['dari']) && isset($_GET['sampai'])) {
  $dari = $_GET['dari'];
  $sampai = $_GET['sampai'];
  if ($dari && $sampai) {
    $where = "WHERE DATE(tanggal) BETWEEN '$dari' AND '$sampai'";
  }
}

// DATA TRANSAKSI
$data = mysqli_query($conn, "
  SELECT * FROM transaksi $where ORDER BY tanggal DESC
");

// DATA GRAFIK
$grafik = mysqli_query($conn, "
  SELECT DATE(tanggal) tgl, SUM(total) total 
  FROM transaksi 
  GROUP BY DATE(tanggal)
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Transaksi</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:"Times New Roman", Times, serif;
}

html{
  scroll-behavior:smooth;
}

body{
  background:radial-gradient(circle at top, #0f2027, #000);
  color:white;
  min-height:200vh;
}

/* BACKGROUND PARTICLE */
.bg span{
  position:fixed;
  width:6px;
  height:6px;
  border-radius:50%;
  background:#00f6ff;
  box-shadow:0 0 15px #ff00ff;
  animation: fall 12s linear infinite;
}

@keyframes fall{
  from{transform:translateY(100vh);opacity:0}
  to{transform:translateY(-10vh);opacity:1}
}

/* CONTAINER */
.container{
  width:90%;
  max-width:1100px;
  margin:80px auto;
  background:rgba(0,0,0,0.6);
  padding:30px;
  border-radius:20px;
  border:2px solid #00f6ff;
  box-shadow:0 0 30px #ff00ff;
  animation: float 3s ease-in-out infinite;
}

@keyframes float{
  0%{transform:translateY(0)}
  50%{transform:translateY(-10px)}
  100%{transform:translateY(0)}
}

/* TITLE */
h2{
  text-align:center;
  margin-bottom:20px;
  color:#00f6ff;
  text-shadow:0 0 15px #ff00ff;
}

/* FILTER */
.filter{
  text-align:center;
  margin-bottom:30px;
}

.filter input, .filter button{
  padding:8px 15px;
  border-radius:20px;
  border:none;
  margin:5px;
}

.filter button{
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  cursor:pointer;
}

/* TABLE */
table{
  width:100%;
  border-collapse:collapse;
}

th, td{
  padding:10px;
  text-align:center;
}

th{
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  color:black;
}

tr:nth-child(even){
  background:rgba(255,255,255,0.05);
}

/* BUTTON */
.back{
  display:inline-block;
  margin-top:20px;
  padding:10px 25px;
  border-radius:25px;
  border:2px solid #00f6ff;
  text-decoration:none;
  color:white;
  box-shadow:0 0 15px #ff00ff;
}

.back:hover{
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
}

/* CHART */
.chart-box{
  margin-top:100px;
}
</style>
</head>

<body>

<!-- PARTICLES -->
<div class="bg">
<?php for($i=0;$i<20;$i++){ ?>
  <span style="left:<?= rand(1,99) ?>%;animation-delay:<?= rand(0,10) ?>s"></span>
<?php } ?>
</div>

<!-- TRANSAKSI -->
<div class="container" id="transaksi">
  <h2>📋 DATA TRANSAKSI</h2>

  <div class="filter">
    <form method="GET">
      Dari: <input type="date" name="dari">
      Sampai: <input type="date" name="sampai">
      <button type="submit">Filter</button>
    </form>
  </div>

  <table>
    <tr>
      <th>No</th>
      <th>User</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Total</th>
      <th>Tanggal</th>
    </tr>

    <?php $no=1; while($t=mysqli_fetch_assoc($data)){ ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $t['username']; ?></td>
      <td><?= $t['produk']; ?></td>
      <td><?= $t['jumlah']; ?></td>
      <td>Rp <?= number_format($t['total']); ?></td>
      <td><?= $t['tanggal']; ?></td>
    </tr>
    <?php } ?>
  </table>

  <center>
    <a href="#grafik" class="back">⬇ Lihat Grafik</a>
  </center>
</div>

<!-- GRAFIK -->
<div class="container chart-box" id="grafik">
  <h2>📊 GRAFIK PENJUALAN</h2>
  <canvas id="chartTransaksi"></canvas>

  <center>
    <a href="../dashboard.php" class="back">⬅ Kembali Dashboard</a>
  </center>
</div>

<script>
const ctx = document.getElementById('chartTransaksi');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
      <?php while($g=mysqli_fetch_assoc($grafik)){
        echo "'".$g['tgl']."',";
      } ?>
    ],
    datasets: [{
      label: 'Total Penjualan',
      data: [
        <?php
        mysqli_data_seek($grafik,0);
        while($g=mysqli_fetch_assoc($grafik)){
          echo $g['total'].",";
        }
        ?>
      ],
      borderColor: '#00f6ff',
      backgroundColor: 'rgba(255,0,255,0.3)',
      tension:0.4
    }]
  }
});
</script>

</body>
</html>
