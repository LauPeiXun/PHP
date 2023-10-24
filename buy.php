<?php
//start session
session_start();
define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('NAME', 'assignment');

// function that for checking user log in or no
function checkLoggedIn()
{
    if (!isset($_SESSION['student_id'])) {
        echo "<script>alert('Please kindly log-in first.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
}

// if user logged in, display the form
if (isset($_SESSION['student_id'])) {

    //connect to the database
    $db = mysqli_connect(HOST, USER, PASSWORD, NAME);
    if (!$db) {
        die('Could not connect to MySQL:' . mysqli_connect_error());
    }

	$sql = "SELECT event_title, price FROM event";    $result = mysqli_query($db, $sql);

    if (!$result) {
        die("Error retrieving events information: " . mysqli_error($db));
    }

    $options = "";

	while ($row = mysqli_fetch_assoc($result)) {
		$options .= "<option value=\"" . $row['event_title'] . "\" data-price=\"" . $row['price'] . "\">" . $row['event_title'] . "</option>";
	}
    // close the database connection
    mysqli_close($db);
    ?>

<!DOCTYPE html>
<html>

<head>
	<title>Purchase Tickets</title>
	<link rel="stylesheet" href="buy.css">
</head>

<body>
	<?php include('header.php'); ?>
	<h1 id="title" style="color:white; text-align:center;">Purchase Ticket</h1>
	<div id="formLayout">
		<div id="form-container">
			<form action="process.php" method="POST">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" required />
				<label for="course">Course:</label>
				<input type="text" name="course" id="course" required />
				<label for="class">Class/Year:</label>
				<input type="text" name="class" id="class" placeholder="DFT1Y1S3" required />
				<label for="phone">Phone Number:</label>
				<input type="tel" name="phone" id="phone" required />
				<label for="event">Events type:</label>
				<select name="event" id="event" onchange="showTicketPrice()">
   			 		<?php echo $options; ?>
				</select>
				<label for="seat">Quantity:</label>
				<input type="number" name="qty" id="qty" min="1" max="8" placeholder="Maximum 8 tickets only" onchange="showTicketPrice()" required />
				<label for="price">Ticket Price:</label>
				<label id="priceLabel"></label>

				<script>
					function showTicketPrice() {
						var eventSelect = document.getElementById("event");
						var priceLabel = document.getElementById("priceLabel");
						var selectedOption = eventSelect.options[eventSelect.selectedIndex];
						var price = selectedOption.dataset.price;
						var qty = document.getElementById("qty").value;
						var totalPrice = price * qty;
						priceLabel.innerText = "RM" + totalPrice;
					}
				</script>
				
				<input type="reset" value="Reset">
				<input type="submit" value="Purchase Ticket">
			</form>
		</div>
	</div>
	<?php include("footer.php"); ?>
</body>

</html>
<?php
} else {
    // connect back to php then check if user is not logged in, redirect to login page
    checkLoggedIn();
}
?>