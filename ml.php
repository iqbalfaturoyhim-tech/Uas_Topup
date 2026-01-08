<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../koneksi.php";

if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit;
}

$dm_list = [
  10, 50, 100, 250, 500,
  1000, 2500, 5000, 10000,
  50000, 100000, 250000,
  500000, 900000
];

$tarif = 15;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Top Up Mobile Legends</title>
<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:"Times New Roman", Times, serif;
}

body{
  min-height:100vh;
  background:radial-gradient(circle at top, #0f2027, #000);
  color:white;
  overflow-x:hidden;
}

/* Efek background */
.bg span{
  position:absolute;
  width:6px;
  height:6px;
  background:#00f6ff;
  box-shadow:0 0 15px #ff00ff;
  border-radius:50%;
  animation:move 12s linear infinite;
}
.bg span:nth-child(even){
  background:#ff00ff;
  box-shadow:0 0 15px #00f6ff;
}
@keyframes move{
  from{transform:translateY(100vh);opacity:0}
  to{transform:translateY(-10vh);opacity:1}
}

/* Form Box */
.box{
  margin:90px auto 50px auto;
  background:rgba(0,0,0,.65);
  padding:30px 35px;
  width:420px;
  border-radius:20px;
  border:2px solid #00f6ff;
  box-shadow:0 0 25px #00f6ff,0 0 45px #ff00ff;
  animation:float 3s ease-in-out infinite;
}
@keyframes float{
  0%{transform:translateY(0)}
  50%{transform:translateY(-12px)}
  100%{transform:translateY(0)}
}

h2{
  text-align:center;
  margin-bottom:20px;
  color:#00f6ff;
  text-shadow:0 0 15px #00f6ff,0 0 25px #ff00ff;
}

input, select, button{
  width:100%;
  padding:12px;
  margin-bottom:14px;
  border:none;
  border-radius:25px;
  outline:none;
  font-size:16px;
  transition: all 0.3s ease;
}

input{
  background:rgba(255,255,255,.1);
  color:white;
  text-align:center;
  box-shadow:0 0 10px #00f6ff inset;
}

select{
  background: rgba(0,0,0,0.7);
  color: #00f6ff;
  text-align: center;
  font-size: 16px;
  box-shadow: 0 0 15px #00f6ff inset, 0 0 25px #ff00ff inset;
  appearance: none;
  cursor: pointer;
}

select:hover, select:focus{
  background: linear-gradient(45deg, #00f6ff, #ff00ff);
  color: #fff;
  box-shadow:0 0 25px #00f6ff,0 0 35px #ff00ff;
}

button{
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  color:white;
  cursor:pointer;
  box-shadow:0 0 20px #00f6ff,0 0 35px #ff00ff;
}
button:hover{transform:scale(1.05)}

/* Invoice */
.invoice-wrapper{
  display:flex;
  flex-direction:column;
  align-items:center;
  margin:30px 0;
}

.invoice{
  width:700px;
  max-width:95%;
  padding:20px;
  background:#fff;
  color:#000;
  border-radius:10px;
  font-family:"Times New Roman", Times, serif;
}

.print-btn{
  display:block;
  margin-top:15px;
  padding:10px 20px;
  cursor:pointer;
}
</style>
</head>
<body>

<div class="bg">
<?php for($i=1;$i<=20;$i++): ?>
<span style="left:<?= rand(1,100) ?>%;animation-delay:<?= rand(0,10) ?>s"></span>
<?php endfor; ?>
</div>

<div class="box">
<h2>TOP UP MOBILE LEGENDS</h2>
<form method="POST">
<input type="text" name="id_game" placeholder="ID Game ML" required>
<input type="text" name="id_server" placeholder="ID Server ML" required>
<input type="text" name="username_game" placeholder="Username ML" required>

<select name="jumlah" required>
<?php foreach($dm_list as $d): ?>
<option value="<?= $d ?>"><?= number_format($d) ?> Diamond</option>
<?php endforeach; ?>
</select>

<select name="pembayaran_via" required>
<option value="">-- Pembayaran Via --</option>
<option>Dana</option>
<option>OVO</option>
<option>Gopay</option>
<option>QRIS</option>
</select>

<input type="text" name="voucher" placeholder="Kode Voucher (opsional)">
<button name="beli">BELI</button>

<a href="../dashboard.php" style="display:block;text-align:center;margin-top:10px;color:#00f6ff;text-decoration:none;font-weight:bold;">← Kembali ke Dashboard</a>
</form>
</div>

<?php
if(isset($_POST['beli'])){
  $invoice="INV-ML-".date("YmdHis");
  $id_game=$_POST['id_game'];
  $id_server=$_POST['id_server'];
  $username_game=$_POST['username_game'];
  $jumlah=$_POST['jumlah'];
  $pembayaran=$_POST['pembayaran_via'];
  $voucher=$_POST['voucher'];

  $total=$jumlah*$tarif;
  if($voucher=="RIXXIE10") $total-=10000;

  mysqli_query($conn,"INSERT INTO transaksi
  (invoice,username,produk,jumlah,total,id_game,id_server,username_game,pembayaran_via,voucher,status)
  VALUES
  ('$invoice','$_SESSION[username]','ML $jumlah Diamond','$jumlah','$total',
   '$id_game','$id_server','$username_game','$pembayaran','$voucher','Pending')");
?>

<div class="invoice-wrapper">
  <div class="invoice" id="invoice">
    <h2 align="center">INVOICE RIXXIE STORE</h2><hr>
    <table cellpadding="6" width="100%">
      <tr><td>Invoice</td><td>: <b><?= $invoice ?></b></td></tr>
      <tr><td>User</td><td>: <?= $_SESSION['username'] ?></td></tr>
      <tr><td>ID Game</td><td>: <?= $id_game ?></td></tr>
      <tr><td>ID Server</td><td>: <?= $id_server ?></td></tr>
      <tr><td>Username Game</td><td>: <?= $username_game ?></td></tr>
      <tr><td>Produk</td><td>: <?= $jumlah ?> Diamond</td></tr>
      <tr><td>Pembayaran</td><td>: <?= $pembayaran ?></td></tr>
      <tr><td>Total</td><td><b>: Rp <?= number_format($total) ?></b></td></tr>
      <tr><td>Status</td><td>: Pending</td></tr>
    </table>
    <hr>
    <p align="center">Terima kasih telah bertransaksi di RIXXIE STORE</p>
  </div>

  <button class="print-btn" onclick="printInvoice()">🖨️ Cetak / Simpan PDF</button>
</div>

<script>
function printInvoice(){
  var w=window.open('','','width=900,height=700');
  w.document.write(document.getElementById('invoice').outerHTML);
  w.document.close();
  w.print();
}
</script>

<?php } ?>
</body>
</html> 