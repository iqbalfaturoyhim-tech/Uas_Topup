<?php
session_start();
include "../koneksi.php";

if ($_SESSION['role'] != 'admin') {
  header("Location: ../dashboard.php");
  exit;
}

/* =========================
   EXPORT EXCEL (1 FILE)
========================= */
if (isset($_GET['export']) && $_GET['export'] == 'excel') {

  header("Content-Type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=data_transaksi.xls");

  $data = mysqli_query($conn,"SELECT * FROM transaksi ORDER BY tanggal DESC");

  echo "<table border='1'>
  <tr>
    <th>No</th>
    <th>Invoice</th>
    <th>User</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Total</th>
    <th>Tanggal</th>
  </tr>";

  $no=1;
  while($t=mysqli_fetch_assoc($data)){
    echo "<tr>
      <td>".$no++."</td>
      <td>".$t['invoice']."</td>
      <td>".$t['username']."</td>
      <td>".$t['produk']."</td>
      <td>".$t['jumlah']."</td>
      <td>".$t['total']."</td>
      <td>".$t['tanggal']."</td>
    </tr>";
  }

  echo "</table>";
  exit;
}

/* =========================
   DATA DASHBOARD
========================= */
$data = mysqli_query($conn,"SELECT * FROM transaksi ORDER BY tanggal DESC");

$grafik = mysqli_query($conn,"
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

html{ scroll-behavior:smooth; }

body{
  background:radial-gradient(circle at top,#0f2027,#000);
  color:white;
  min-height:200vh;
}

/* CONTAINER */
.container{
  width:90%;
  max-width:1100px;
  margin:80px auto;
  background:rgba(0,0,0,0.65);
  padding:30px;
  border-radius:20px;
  border:2px solid #00f6ff;
  box-shadow:0 0 25px #ff00ff;
}

/* TITLE */
h2{
  text-align:center;
  color:#00f6ff;
  text-shadow:0 0 15px #ff00ff;
  margin-bottom:20px;
}

/* BUTTON */
.btn{
  display:inline-block;
  padding:10px 20px;
  border-radius:25px;
  text-decoration:none;
  color:black;
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  font-weight:bold;
  margin:10px;
}

/* TABLE */
table{
  width:100%;
  border-collapse:collapse;
}

th,td{
  padding:10px;
  text-align:center;
}

th{
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  color:black;
}

tr:nth-child(even){
  background:rgba(255,255,255,0.08);
}
</style>
</head>

<body>

<div class="container">
  <h2>📋 DATA TRANSAKSI</h2>

  <center>
    <a href="?export=excel" class="btn">⬇ Export Excel</a>
    <a href="#grafik" class="btn">📊 Lihat Grafik</a>
  </center>

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
</div>

<div class="container" id="grafik">
  <h2>📊 GRAFIK PENJUALAN</h2>
  <canvas id="chartTransaksi"></canvas>

  <center>
    <a href="../dashboard.php" class="btn">⬅ Kembali</a>
  </center>
</div>

<script>
const ctx = document.getElementById('chartTransaksi');

new Chart(ctx,{
  type:'line',
  data:{
    labels:[
      <?php while($g=mysqli_fetch_assoc($grafik)){
        echo "'".$g['tgl']."',";
      } ?>
    ],
    datasets:[{
      label:'Total Penjualan (Rp)',
      data:[
        <?php
        mysqli_data_seek($grafik,0);
        while($g=mysqli_fetch_assoc($grafik)){
          echo $g['total'].",";
        }
        ?>
      ],
      borderColor:'#00ffff',
      backgroundColor:'rgba(255,0,255,0.45)',
      pointBackgroundColor:'#ff00ff',
      pointBorderColor:'#ffffff',
      pointRadius:6,
      borderWidth:3,
      fill:true,
      tension:0.4
    }]
  },
  options:{
    plugins:{
      legend:{ labels:{color:'white'} }
    },
    scales:{
      x:{ ticks:{color:'white'} },
      y:{ ticks:{color:'white'} }
    }
  }
});
</script>

</body>
</html>
