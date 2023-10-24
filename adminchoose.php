<?php
  session_start();
?>

<html>
<head>
     <img src="/assignment/picture/logout.png" alt="back" usemap="#logoutmap" class="logout" style="  position: absolute;top: 10px;right: 10px;width: 85px;height: 70px;">
     <br>
     <map name="#logoutmap">
          <area shape="rect" coords="0,0,1780,120"alt="logout" href="adminlogout.php">
     </map>
  <style>

video {
position: absolute;
right: 0;
bottom: 0;
min-width: 100%;
min-height: 100%;
z-index: -1;
object-fit: cover;
}

a{
     font-size: 20px;
}

.e a:hover {
box-shadow: 4px 4px 10px rgba(0,0,0,0.5);
}

.e a {
     display: block;
     background-color: rgb(228, 211, 228);
     color: rgb(0, 0, 0);
     padding: 20px 70px;
     margin: 10px auto;
     width: 200px;
     text-align: center;
     text-decoration: none;
     border-radius: 5px;
     box-shadow: 2px 2px 5px rgb(1, 255, 234);
}

p {
     text-align: center;
     color:white;
     font-size: 30px;
     font-weight: bold;
}

html, body {
     height: 100%;
     margin: 0;
}

body {
background-position: center;
background-size: cover;
display: flex;
flex-direction: column;
justify-content: center;
position: relative;
}

body::before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.3);
  z-index: -1;
}


  </style>
</head>

<body>
<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
     <div class="e">
    <a href="display.php">Manage Event Info</a>
  </div>
  <p >OR</p>
  <div class="e">
    <a href="manage.php">Manage Ticket Info</a>
  </div>
  <p >OR</p>
  <div class="e">
    <a href="changepassword.php">Change Password</a>
  </div>
</body>
</html>