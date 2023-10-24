<?php
  session_start();
?>

<html>
<head>
  <style>
 body{
     background: url(/assignment/picture/background.gif);
     background-size: cover;
     padding: 0%;
     margin: 0%;
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
     font-weight: bold;
     font-size: 20px;
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

html{
     padding: auto;
     margin: auto;
   }

body {
background-position: center;
background-size: cover;
display: flex;
flex-direction: column;
justify-content: center;

}

#tarumt {
		height: 70px;
		width: 300px;
	}

     div#logo {
          margin-bottom: 150px;
          margin-left: 10px;
          margin-top: 10px;
     }

  </style>
</head>

<body>
<div id="logo"><img id="tarumt" src="picture/tarumt.png" alt="logo" /></div>
     <div class="e">
    <a href="login.php">Student Page</a>
  </div>
  <p >OR</p>
  <div class="e">
    <a href="adminlogin.php">Admin Page</a>
  </div>
</body>
</html>