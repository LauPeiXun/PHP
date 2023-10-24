<html>

<head>
	<title>Updated Information</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="updateevent.css" />
</head>

<body>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<?php include('header1.php'); ?>
	<h1>Updated Event Information</h1>
	<?php
// Establish a database connection
     define('USER', 'root');
	define('PASSWORD', '');
	define('HOST', 'localhost');
	define('NAME', 'assignment');
	$conn = mysqli_connect(HOST, USER, PASSWORD, NAME);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Check if the ID parameter is set
	if (!isset($_POST['event_title'])) {
	    die("ID parameter is missing.");
	}

	// Retrieve the event information from the form data
	$event_name = $_POST['event_title'];
	$event_date = $_POST['event_date'];
	$event_location = $_POST['event_location'];
	$price = $_POST['price'];

	// Update the event information in the database using prepared statements
	$add = $conn->prepare("UPDATE event SET date=?, place=?, price=? WHERE event_title=?");
	$add->bind_param("ssss", $event_date, $event_location, $price, $event_name);

	if ($add->execute()) {
	    // Display the updated event information
	    echo "<script>alert('Event updated successfully !');</script>";
	    echo "<div class='event-details'>";
	    echo "Event Name: $event_name<br>";
	    echo "Event Date: $event_date<br>";
	    echo "Event Location: $event_location<br>";
	    echo "Ticket Price: RM$price<br>";
	    echo "</div>";
	} else {
	    echo "Error updating event: " . mysqli_error($conn);
	}

	// Close the prepared statement and the database connection
	$add->close();
	mysqli_close($conn);
	?>

	<!-- HTML code to add a button -->
	<button onclick="location.href='addevent.php'" style="width:100%;">Add New Event</button>

</body>
<?php //include('footer1.php');?>

</html>