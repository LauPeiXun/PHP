<!DOCTYPE html>
<html>

<head>
	<title>Update Seat Availability</title>
	<link rel="stylesheet" type="text/css" href="updateseat.css">
</head>

<body>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<?php include('header1.php'); ?>
	<h1>Update Remaining Seats</h1>
	<?php
    //connect to database
    define('USER', 'root');
	define('PASSWORD', '');
	define('HOST', 'localhost');
	define('NAME', 'assignment');
	$conn = mysqli_connect(HOST, USER, PASSWORD, NAME);

	//check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	//retrieve events from database
	$sql = "SELECT event_id, event_title FROM event";
	$result = mysqli_query($conn, $sql);
	$options="";

	//display event names in dropdown list
	while ($row = mysqli_fetch_assoc($result)) {
	    $options .= "<option value=\"" . $row['event_id'] . "\">" . $row['event_title'] . "</option>";
	}

	//if the form is submitted
	if(isset($_POST['submit'])) {

	    //get event name and remaining seat from form
	    $id = $_POST['event_id'];
	    $seatremain = $_POST['seatremain'];

	    //update remaining seat in database
	    $sql = "UPDATE event SET seatremain='$seatremain' WHERE event_id='$id'";

	    if (mysqli_query($conn, $sql)) {
		   echo "<script>alert('Remaining seats updated successfully');</script>";
		   echo "<script>window.location.href = 'display.php';</script>";
		   $seatremain = $eventname ="";
	    } else {
	        echo "Error updating remaining seats: " . mysqli_error($conn);
	    }
	}

	if(!empty($eventname)) {
	    $sql = "SELECT seat, seatremain FROM event WHERE event_title='$eventname'";
	    $result = mysqli_query($conn, $sql);
	    $row = mysqli_fetch_assoc($result);
	    $current_totalseat = $row['seat'];
	    $current_seatremain = $row['seatremain'];
	} else {
	    $current_totalseat = "";
	    $current_seatremain = "";
	}

	mysqli_close($conn);
	?>

	<form method="post"
		action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<label for="event_name">Select Event:</label>
		<select name="event_id" required>
			<?php echo $options; ?>
		</select><br>
		<label for="seatremain">Remain Seat:</label>
		<input type="number" name="seatremain"
			value="<?php echo $current_seatremain; ?>" required><br>

		<input type="submit" name="submit" value="Update Remaining Seats">
		<input type="reset" value="Reset" />
	</form>

</body>
<?php //include('footer1.php'); ?>
</html>