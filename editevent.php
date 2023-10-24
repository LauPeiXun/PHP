<!DOCTYPE html>
<html>

<head>
	<title>Add New Event</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="editevent.css" />
</head>

<body>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<?php include('header1.php'); ?>
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
if (!isset($_GET['event_id'])) {
	die("ID parameter is missing.");
 }
 
 // Retrieve the selected event name from the URL
 $event_id = $_GET['event_id'];

 // Query the database for the event information
$event_query = "SELECT * FROM event WHERE event_id = '$event_id'";
$event_result = mysqli_query($conn, $event_query);

 if (!$event_result) {
	die("Failed to retrieve event information: " . mysqli_error($conn));
 }
 
 // Check if the event exists
 if (mysqli_num_rows($event_result) > 0) {
	// Get the event data
	$event_data = mysqli_fetch_assoc($event_result);
	$event_name = $event_data['event_title'];
	$event_detail = $event_data['event_description'];
	$event_genre = $event_data['genre'];
	$event_date = $event_data['date'];
	$event_location = $event_data['place'];
	$price = $event_data['price'];
 
	    // Display the event information
	    echo "<h1>Event Name: $event_name</h1>";

	    echo "<div class='event-details'>";
	    echo "<p>Description: $event_detail</p>";
	    echo "<p>Date: $event_date</p>";
	    echo "<p>Genre: $event_genre</p>";
	    echo "<p>Location: $event_location</p>";
	    echo "<p>Price: RM$price</p>";
	    echo "</div>";

	    // Display the edit form with the selected event name
	    echo '<form action="updateevent.php" method="post">
    <label for="event_title">Event Name:</label>
    <input type="text" name="event_title" value="' . $event_name . '" readonly><br>
    <label for="event_date">Event Date:</label>
    <input type="date" name="event_date" value="' . ($event_date ?? '') . '"><br>
    <label for="event_location">Event Location:</label>
    <input type="text" name="event_location" value="' . ($event_location ?? '') . '"><br>
    <label for="price">Ticket Price:</label>
    <input type="number" name="price" value="' . ($price ?? '') . '"><br>
    <input type="submit" value="Update Event">
    </form>';

	    // Add a delete button that sends a DELETE request to a separate PHP script
	    echo '<form action="deleteevent.php" method="post">
    <input type="hidden" name="event_id" value="' . $event_id . '">
    <input type="submit" value="Delete Event">
    </form>';

	    // Add a JavaScript function to ask user confirm delete or not
	    echo '<script>
document.querySelector("form[action=\'deleteevent.php\']").addEventListener("submit", function(event) {
    event.preventDefault();
    var confirmation = confirm("Are you sure you want to delete this event?");
    if (confirmation) {
        this.submit();
    }
});
</script>';

	} else {
	    echo "Event not found.";
	}

	// Close the database connection
	mysqli_close($conn);
	?>
</body>
<?php //include('footer1.php'); ?>
</html>