<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard RIXXIE</title>

<style>
/* RESET */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:"Times New Roman", Times, serif;
}

/* BODY */
body{
  height:100vh;
  background: radial-gradient(circle at top, #0f2027, #000);
  display:flex;
  justify-content:center;
  align-items:center; /* ⬅️ TENGAH */
  overflow:hidden;
  color:white;
}

/* BACKGROUND PARTICLES */
.bg{
  position:fixed;
  width:100%;
  height:100%;
  top:0;
  left:0;
  z-index:-1;
}

.bg span{
  position:absolute;
  width:6px;
  height:6px;
  background:#00f6ff;
  border-radius:50%;
  box-shadow:0 0 15px #ff00ff;
  animation: move 12s linear infinite;
  opacity:0.7;
}

.bg span:nth-child(even){
  background:#ff00ff;
  box-shadow:0 0 15px #00f6ff;
}

@keyframes move{
  from{
    transform:translateY(100vh) translateX(0);
    opacity:0;
  }
  to{
    transform:translateY(-10vh) translateX(60px);
    opacity:1;
  }
}

/* DASHBOARD BOX */
.dashboard{
  padding:40px;
  width:420px;
  text-align:center;
  background:rgba(0,0,0,0.6);
  border-radius:22px;
  border:2px solid #00f6ff;
  box-shadow:
    0 0 25px #00f6ff,
    0 0 50px #ff00ff;
  animation: float 3s ease-in-out infinite;
}

@keyframes float{
  0%{transform:translateY(0);}
  50%{transform:translateY(-15px);}
  100%{transform:translateY(0);}
}

/* TITLE */
.dashboard h2{
  font-size:28px;
  margin-bottom:10px;
  color:#00f6ff;
  text-shadow:
    0 0 10px #00f6ff,
    0 0 25px #ff00ff;
}

.dashboard p{
  margin-bottom:30px;
  font-size:18px;
  color:#ff9dff;
}

/* BUTTON MENU */
.menu a{
  display:block;
  margin:15px 0;
  padding:14px;
  text-decoration:none;
  color:white;
  font-size:18px;
  border-radius:30px;
  border:2px solid #00f6ff;
  background:transparent;
  box-shadow:
    0 0 15px #00f6ff,
    0 0 25px #ff00ff;
  transition:0.3s;
}

.menu a:hover{
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  transform:scale(1.05);
  box-shadow:
    0 0 30px #00f6ff,
    0 0 50px #ff00ff;
}

/* LOGOUT */
.logout{
  margin-top:25px;
  display:inline-block;
  color:#ff7070;
  text-decoration:none;
  font-size:16px;
}

.logout:hover{
  text-shadow:0 0 10px red;
}
</style>
</head>

<body>

<!-- PARTICLES -->
<div class="bg">
  <span style="left:10%;animation-delay:0s"></span>
  <span style="left:20%;animation-delay:2s"></span>
  <span style="left:30%;animation-delay:4s"></span>
  <span style="left:40%;animation-delay:1s"></span>
  <span style="left:50%;animation-delay:3s"></span>
  <span style="left:60%;animation-delay:5s"></span>
  <span style="left:70%;animation-delay:2s"></span>
  <span style="left:80%;animation-delay:4s"></span>
  <span style="left:90%;animation-delay:1s"></span>
</div>

<!-- DASHBOARD -->
<div class="dashboard">
  <h2>DASHBOARD RIXXIE</h2>
  <p>Selamat datang, <b><?= $_SESSION['username']; ?></b></p>

  <div class="menu">
    <?php if($_SESSION['role'] == 'admin'){ ?>
      <a href="admin/produk.php">⚙ Kelola Produk</a>
      <a href="admin/transaksi.php">📊 Data Transaksi</a>
    <?php } else { ?>
      <a href="pembeli/roblox.php">🎮 Top Up Roblox</a>
      <a href="pembeli/ml.php">🔥 Top Up Mobile Legends</a>
    <?php } ?>
  </div>

  <a href="logout.php" class="logout">🚪 Logout</a>
</div>

</body>
</html>
