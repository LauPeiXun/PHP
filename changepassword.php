<?php
  session_start();
?>
<style>
/* Body styles */
body {
  background-position: center;
}

video {
  /* position: absolute; */
  right: 0;
  bottom: 0;
  min-width: 100%;
  min-height: 100%;
  z-index: -1;
  object-fit: cover;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  }
  
  /* Form styles */
  form {
    width: 600px;
    margin: 160px auto;
  }
  
  label {
    display: inline-block;
    width: 150px;
    font-weight: bold;
  }
  
  input[type="password"] {
    width: 200px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #ffffff;
    box-shadow: 0px 0px 5px 0px #bfbfbf;
    border-radius: 20px;
    width: 300px;
  }
  
  input[type="submit"] {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #8e24aa;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
  }
  
  input[type="submit"]:hover {
    background-color: #93dceb;
  }
  
  /* Table styles */
  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 20px;
  }
  
  th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
  }
  
  th {
    background-color: #9c27b0;
    color: #fff;
  }
  
  td {
    background-color: #a98fca;
  }
  
  tr:nth-child(even) td {
    background-color: #a2cbd5;
  }

</style>
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'assignment');

if (isset($_POST['submit']))
{
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "SELECT password FROM admininfo";
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $oldpassword = $_POST['oldpassword'];
    $result = $con->query($sql);
    $row = $result->fetch_object();
    
    if($oldpassword==$row-> password&&$password==$confirmpassword)
    {
    $sql = "UPDATE admininfo SET password='$password' WHERE adminid='TAR1234'";

    if ($con->query($sql) === TRUE) {
        $a = "Password updated successfully !";
        $color = "green"; 
    } 
    else {
        $a= "Error updating password: ";
        $color = "red"; 
    }
    echo "<p style='color: $color; font-size: 30px; text-align: center; background-color: #f5eefc; padding: 20px; border-radius: 5px;'>$a</p>";

}

else if($oldpassword!=$row-> password)
{
    echo "<script>alert('Incorrect password. Please try again.');</script>";
}

else if($password!=$confirmpassword)
{
    echo "<script>alert('New assword and Confirm Password are not same. Please try again.');</script>";
}
    $con->close();
}

function htmlOldPassword($name, $value = '', $maxlength = '')
{
    printf('<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

function htmlPassword($name, $value = '', $maxlength = '')
{
    printf('<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

function htmlConfirmPassword($name, $value = '', $maxlength = '')
{
    printf('<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}
?>

<html>
<head>
        <meta charset="UTF-8">
        <img src="picture/arrow.png" alt="back" usemap="#backmap" style="width:65px;height:55px;" />
        <map name="#backmap">
            <area shape="rect" coords="0,0,107,99"alt="back" href="adminchoose.php">
        </map>
        <img src="picture/logout.png" alt="back" usemap="#logoutmap" class="logout" style="  position: absolute;top: 10px;right: 10px;width: 85px;height: 70px;">
        <br>
        <map name="#logoutmap">
            <area shape="rect" coords="0,0,1780,120"alt="logout" href="adminlogout.php">
        </map>
</head>
<body>
<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
    <br>
    <form action="" method="post">
      <p style="font-weight: bold; font-size:40px; text-align:center;">Change Password</p>
        <table>
            <tr>
            <td><label for="oldpassword">Old Password :</label></td>
                <td>
                    <?php htmlOldPassword('oldpassword') ?>
                </td>
            </tr>
            <tr>
                <td><label for="password">New Password :</label></td>
                <td>
                    <?php htmlPassword('password') ?>
                </td>
            </tr>
            <tr>
                <td><label for="confirmpassword">Confirm Password :</label></td>
                <td>
                    <?php htmlConfirmPassword('confirmpassword') ?>
                </td>
            </tr>
            <tr>
            <td><input type="submit" name="submit" value="Confirm" /></td>
            </tr>
        </table>
    </form>
</body>
<?php //include('footer1.php'); ?>
</html>