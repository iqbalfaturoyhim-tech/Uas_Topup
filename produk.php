<?php
// DAFTAR NOMINAL
$nominal_list = [
  10, 25, 50, 100, 150,
  250, 500, 750, 1000,
  1500, 2500, 5000,
  7500, 10000, 15000,
  25000, 50000, 100000
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Produk</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:"Times New Roman", Times, serif;
}

body{
  height:100vh;
  background:radial-gradient(circle at top, #fe14d7ff, #000);
  display:flex;
  justify-content:center;
  align-items:center;
  overflow:hidden;
  color:white;
}

/* PARTICLES */
.bg{
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  z-index:-1;
}
.bg span{
  position:absolute;
  width:6px;
  height:6px;
  background:#00f6ff;
  border-radius:50%;
  box-shadow:0 0 15px #ff00ff;
  animation:naik 12s linear infinite;
}
.bg span:nth-child(even){
  background:#ff00ff;
  box-shadow:0 0 15px #00f6ff;
}
@keyframes naik{
  from{transform:translateY(110vh);opacity:0}
  to{transform:translateY(-10vh);opacity:1}
}

/* BOX */
.box{
  width:380px;
  padding:35px;
  background:rgba(0,0,0,0.6);
  border-radius:20px;
  border:2px solid #00f6ff;
  box-shadow:0 0 20px #00f6ff,0 0 40px #ff00ff;
  text-align:center;
  animation:float 3s ease-in-out infinite;
}
@keyframes float{
  0%{transform:translateY(0)}
  50%{transform:translateY(-12px)}
  100%{transform:translateY(0)}
}

.box h2{
  margin-bottom:25px;
  font-size:26px;
  color:#00f6ff;
  text-shadow:0 0 10px #00f6ff,0 0 20px #ff00ff;
}

.box input,
.box select{
  width:100%;
  padding:12px;
  margin-bottom:18px;
  border:none;
  outline:none;
  border-radius:25px;
  background:rgba(255,255,255,0.1);
  color:white;
  text-align:center;
  font-size:16px;
  box-shadow:0 0 10px #00f6ff inset;
}

.box select option{
  background:#000;
  color:white;
}

.box button{
  width:100%;
  padding:12px;
  border:none;
  border-radius:25px;
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  color:white;
  font-size:18px;
  cursor:pointer;
  box-shadow:0 0 20px #00f6ff,0 0 30px #ff00ff;
}
.box button:hover{
  transform:scale(1.05);
}

.box a{
  display:inline-block;
  margin-top:15px;
  color:#ff7bff;
  text-decoration:none;
}
.box a:hover{color:#00f6ff}
</style>
</head>

<body>

<div class="bg">
<?php for($i=1;$i<=20;$i++): ?>
<span style="left:<?= rand(1,100) ?>%;animation-delay:<?= rand(0,10) ?>s"></span>
<?php endfor; ?>
</div>

<div class="box">
  <h2>Tambah Produk</h2>

  <form method="POST" action="produk_tambah.php">
    <input type="text" name="nama_produk" placeholder="Nama Produk" required>

    <select name="game" required>
      <option value="">-- Pilih Game --</option>
      <option value="Roblox">Roblox</option>
      <option value="Mobile Legends">Mobile Legends</option>
    </select>

    <select name="harga" required>
      <option value="">-- Pilih Nominal --</option>
      <?php foreach($nominal_list as $n): ?>
        <option value="<?= $n ?>">
          <?= number_format($n) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <button type="submit">Tambah</button>
  </form>

  <a href="../dashboard.php">⬅ Kembali</a>
</div>

</body>
</html> 

