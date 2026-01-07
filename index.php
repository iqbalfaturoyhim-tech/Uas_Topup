<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>RIXXIE TOPUP</title>

<style>
/* RESET */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

/* BODY */
body{
  height:100vh;
  background: radial-gradient(circle at top, #0f2027, #000);
  display:flex;
  justify-content:center;
  align-items:center;
  font-family:'Segoe UI', sans-serif;
  color:white;
  overflow:hidden;
}

/* BACKGROUND ANIMATION */
.bg-animation{
  position:fixed;
  width:100%;
  height:100%;
  top:0;
  left:0;
  z-index:-1;
}

.bg-animation span{
  position:absolute;
  width:8px;
  height:8px;
  background:#00f6ff;
  box-shadow:0 0 15px #ff00ff;
  animation: move 12s linear infinite;
  border-radius:50%;
  opacity:0.7;
}

.bg-animation span:nth-child(odd){
  background:#ff00ff;
  box-shadow:0 0 15px #00f6ff;
}

@keyframes move{
  from{
    transform:translateY(100vh);
    opacity:0;
  }
  to{
    transform:translateY(-10vh);
    opacity:1;
  }
}

/* CONTAINER */
.container{
  text-align:center;
  animation: float 3s ease-in-out infinite;
}

/* TITLE */
.container h1{
  font-size:3rem;
  color:#00f6ff;
  text-shadow:
    0 0 10px #00f6ff,
    0 0 20px #00f6ff,
    0 0 40px #ff00ff;
  margin-bottom:15px;
}

/* DESCRIPTION */
.container p{
  font-size:1.2rem;
  color:#ff7bff;
  text-shadow:0 0 10px #ff00ff;
  margin-bottom:20px;
}

/* GAME LIST */
.game-list{
  display:flex;
  gap:20px;
  justify-content:center;
  margin-bottom:40px;
}

.game-card{
  padding:14px 26px;
  border-radius:22px;
  border:2px solid #ff00ff;
  background:rgba(0,0,0,0.4);
  box-shadow:
    0 0 15px #ff00ff,
    0 0 25px #00f6ff;
  font-size:1rem;
  transition:0.3s;
}

.game-card:hover{
  transform:scale(1.1);
  box-shadow:
    0 0 25px #00f6ff,
    0 0 45px #ff00ff;
}

/* BUTTON */
.btn{
  padding:14px 40px;
  font-size:1.1rem;
  text-decoration:none;
  color:white;
  border:2px solid #00f6ff;
  border-radius:30px;
  background:transparent;
  box-shadow:
    0 0 10px #00f6ff,
    0 0 20px #ff00ff;
  transition:0.3s;
}

.btn:hover{
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  box-shadow:
    0 0 20px #00f6ff,
    0 0 40px #ff00ff;
  transform:scale(1.05);
}

/* FLOAT */
@keyframes float{
  0%{transform:translateY(0);}
  50%{transform:translateY(-15px);}
  100%{transform:translateY(0);}
}
</style>
</head>

<body>

<!-- BACKGROUND PARTICLES -->
<div class="bg-animation">
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

<!-- CONTENT -->
<div class="container">
  <h1>🎮 RIXXIE TOPUP STORE</h1>

  <p>Termurah • Teraman • Terpercaya</p>

  <div class="game-list">
    <div class="game-card">ROBLOX</div>
    <div class="game-card">MOBILE LEGENDS</div>
  </div>

  <a href="login.php" class="btn">LOGIN</a>
</div>

</body>
</html>
