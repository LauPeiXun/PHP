<!DOCTYPE html>
<html>
  <head>
    <title>Purchase Successful !</title>
    <link rel="stylesheet" href="success.css">
  </head>
  <body>
    <?php include("header.php"); ?>
    <div id="box">
      <div id="successBox">
        <p id="successP">Ticket Purchase successfully!</p>
        <div id="tyBox">
          <img src="picture/ty.gif" alt="thankyou" id="ty" />
        </div>
        <div id="word">
          <div id="btn1">
            <a href="event.php">
              <p>Return to homepage</p>
            </a>
          </div>
          <div id="btn2">
            <a href="history.php">
              <p>Purchase history</p>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php include("footer.php"); ?>
  </body>
</html>