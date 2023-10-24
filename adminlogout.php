<?php
  session_start();
  session_destroy();
?>

<script>
  function logoutMessage() {
    alert("You have been logged out!");
    window.location.href = "adminlogin.php";
  }
  
  setTimeout(logoutMessage, 0.15); 
</script>