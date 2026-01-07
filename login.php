<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Rixxie Topup</title>

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

/* BACKGROUND ANIMATION */
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
  box-shadow:0 0 15px #ff00ff;
  border-radius:50%;
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

/* LOGIN BOX */
.login-box{
  padding:35px 40px;
  width:360px;
  text-align:center;
  background:rgba(0,0,0,0.6);
  border-radius:20px;
  border:2px solid #00f6ff;
  box-shadow:
    0 0 20px #00f6ff,
    0 0 40px #ff00ff;
  animation: float 3s ease-in-out infinite;
}

/* FLOAT */
@keyframes float{
  0%{transform:translateY(0);}
  50%{transform:translateY(-12px);}
  100%{transform:translateY(0);}
}

/* TITLE */
.login-box h2{
  margin-bottom:25px;
  font-size:26px;
  color:#00f6ff;
  text-shadow:
    0 0 10px #00f6ff,
    0 0 20px #ff00ff;
}

/* INPUT */
.login-box input{
  width:100%;
  padding:12px;
  margin-bottom:18px;
  border:none;
  outline:none;
  border-radius:25px;
  background:rgba(255,255,255,0.1);
  color:white;
  text-align:center;
  font-size:17px;
  box-shadow:0 0 10px #00f6ff inset;
}

.login-box input::placeholder{
  color:#ffb6ff;
}

/* BUTTON */
.login-box button{
  width:100%;
  padding:12px;
  border:none;
  border-radius:25px;
  background:linear-gradient(45deg,#00f6ff,#ff00ff);
  color:white;
  font-size:18px;
  cursor:pointer;
  box-shadow:
    0 0 20px #00f6ff,
    0 0 30px #ff00ff;
  transition:0.3s;
}

.login-box button:hover{
  transform:scale(1.05);
  box-shadow:
    0 0 30px #00f6ff,
    0 0 50px #ff00ff;
}

/* LINK KEMBALI */
.back-link{
  margin-top:15px;
}

.back-link a{
  color:#00f6ff;
  text-decoration:none;
  font-weight:bold;
  transition:0.3s;
}

.back-link a:hover{
  color:#ff00ff;
  text-shadow:0 0 10px #ff00ff;
}
</style>
</head>

<body>

<!-- BACKGROUND PARTICLES -->
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

<!-- LOGIN FORM -->
<div class="login-box">
  <form method="POST" action="proses_login.php">
    <h2>LOGIN RIXXIE TOPUP</h2>

    <input type="text" name="username" placeholder="Masukkan Username" required>
    <input type="password" name="password" placeholder="Masukkan Password" required>

    <button type="submit">LOGIN</button>
  </form>

  <div class="back-link">
    <a href="index.php">⬅ Kembali</a>
  </div>
</div>

</body>
</html>
