<!DOCTYPE html>
<html>

<head>
	<title>Event</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="display.css" />
</head>

<body>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<?php include('header1.php'); ?>
	<h1>Current Event</h1>
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

	// Select all data from the event_info table
	$sql = "SELECT * FROM event";
	$result = mysqli_query($conn, $sql);

	// Check if any data exists in the table
	if (mysqli_num_rows($result) > 0) {
	    // Output data of each row in a table format
	    echo "<table border='1'>
          <tr>
            <th>Event Name</th>
            <th>Event Description</th>
            <th>Genre</th>
            <th>Event Date</th>
            <th>Event Location</th>
            <th>Ticket Price</th>
            <th>event pic</th>
            <th>total seat</th>
          </tr>";
	    while($row = mysqli_fetch_assoc($result)) {
	        echo "<tr>";
	        echo "<td>" . $row["event_title"]. "</td>";
	        echo "<td>" . $row["event_description"]. "</td>";
	        echo "<td>" . $row["genre"]. "</td>";
	        echo "<td>" . $row["date"]. "</td>";
	        echo "<td>" . $row["place"]. "</td>";
	        echo "<td>RM" . $row["price"]. "</td>";
	        echo '<td><img src="/assignment/picture/'.$row['image'].'" style="width:40px; height:30px;"></td>';
	        echo "<td>" . $row["seat"]. "</td>";
	        echo "</tr>";
	    }
	    echo "</table>";
	} else {
	    echo "0 results";
	}
	// Close the database connection
	mysqli_close($conn);
	?>
</body>
<?php //include('footer1.php');?>

</html>