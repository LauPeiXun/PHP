<!DOCTYPE html>
<html>
<head>
	<title>Add New Event</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="addevent.css" />
</head>

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

$name = $eventname = $date =$detail=$genre= $location = $ticketprice = $eventpic = $totalseat ="";
$error;
$error=array();

// Insert input data into the database
if (!empty($_POST)) {
    $eventname    = trim($_POST['eventname']);
    $date         = trim($_POST['date']);
    $location     = trim($_POST['location']);
    $detail       = trim($_POST['event-detail']);
    $genre        = trim($_POST['genre']);
    $ticketprice  = trim($_POST['ticketprice']);
    $eventpic     = $_FILES['eventpic'];
    $totalseat    = trim($_POST['totalseat']);

    $error = detectError();
    $ext = strtolower(pathinfo($eventpic['name'], PATHINFO_EXTENSION));
    if (empty($error)) {
        $save_as = uniqid() . '.' . $ext;
        move_uploaded_file($eventpic['tmp_name'], '/xampp/htdocs/assignment/picture/' .$save_as);
        $sql = "INSERT INTO event (event_title, date, event_description, genre, place, price, image, seat)
     VALUES ('$eventname', '$date', '$detail', '$genre', '$location', '$ticketprice', '$save_as', '$totalseat')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New record created successfully');</script>";
            echo "<script>window.location.href = 'display.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $eventname = $date = $detail = $genre =  $location = $ticketprice = $eventpic = $totalseat = null;
    } else {
        foreach ($error as $err) {
            echo '<p class="error">' . $err . '</p>';
        }
    }
}
// Close the database connection
mysqli_close($conn);

function detectError()
{
    global $eventname, $date, $detail, $genre, $location, $ticketprice,$eventpic,$totalseat;
    $error = array();

    // event name
    if ($eventname == null) {
        $error["eventname"] = 'Please enter <strong>Event Name</strong>.';
    }
    // event date
    if ($date == null) {
        $error["date"] = 'Please enter <strong>Event Date</strong>.';
    }
    // detail
    if ($detail == null) {
        $error["detail"] = 'Please enter a <strong>Event Detail</strong>.';
    }
    // genre
    if ($genre == null) {
        $error["genre"] = 'Please enter a <strong>Event Genre</strong>.';
    }
    // location
    if ($location == null) {
        $error["location"] = 'Please select a <strong>Event Location</strong>.';
    }
    // Ticket Price
    if ($ticketprice == null) {
        $error["ticketprice"] = 'Please select a <strong>Ticket Price</strong>.';
    }

    //image
    if ($eventpic == null) {
        $error["eventpic"] = 'Please select a <strong>Picture</strong>.';
    }
    return $error;
}
?>

<body>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<?php include('header1.php'); ?>
	<h1>Add New Event</h1>
	<form method="post"
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
		enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="5">
			<tr>
				<td><label for="eventname">Event Name :</label></td>
				<td>
					<input type="text" , name="eventname" id="eventname" required />
				</td>
			</tr>
			<tr>
				<td><label for="event-detail">Event Details :</label></td>
				<td>
					<input type="text" , name="event-detail" id="event-detail" required />
				</td>
			</tr>
			<tr>
				<td><label for="genre">Event Genre :</label></td>
				<td>
					<input type="text" , name="genre" id="genre" required />
				</td>
			</tr>
			<tr>
				<td><label for="date">Event Date :</label></td>
				<td>
					<input type="date" , name="date" id="date" required />
				</td>
			</tr>
			<tr>
				<td><label for="location">Event Location :</label></td>
				<td>
					<input type="text" , name="location" id="location" required />
				</td>
			</tr>
			<tr>
				<td><label for="ticketprice">Ticket Price :</label></td>
				<td>
					<input type="number" , name="ticketprice" id="ticketprice" required />
				</td>
			</tr>
			<tr>
				<td><label for="totalseat">Total Seat :</label></td>
				<td>
					<input type="number" name="totalseat" id="totalseat" required min="200" max="1000" />
				</td>
			</tr>
			<tr>
				<td><label for="eventpic">Event Picture :</label></td>
				<td>
					<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
					<input type="file" , name="eventpic" id="eventpic" />
				</td>

			</tr>
			<?php
if (!empty($error)) {
    // display error messages
    foreach ($error as $err) {
        echo '<p class="error">' . $err . '</p>';
    }
}
?>
		</table>
		<input type="submit" name="submit" value="Submit" />
		<input type="reset" value="Reset" />

	</form>
</body>
<?php //include('footer1.php'); ?>
</html>