<?php
// start session
session_start();

define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('NAME', 'assignment');

// connect to the database
$db = mysqli_connect(HOST, USER, PASSWORD, NAME);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// retrieve the purchase record to edit
$id = $_GET['id'];
$sql = "SELECT student_name, student_id, phone_num, events AS event_name, qty 
          FROM ticket 
          WHERE ticket_id = '$id'";
$result = mysqli_query($db, $sql);

if (!$result) {
    die("Error retrieving purchase history: " . mysqli_error($db));
}

// check if the purchase record exists
if (mysqli_num_rows($result) === 0) {
    die("Purchase record not found");
}

$row = mysqli_fetch_assoc($result);
$event_name = $row['event_name'];
$qty = $row['qty'];
$name = $row['student_name'];
$student_id = $row['student_id'];
$phone = $row['phone_num'];

// handle form submission
if (isset($_POST['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM ticket WHERE ticket_id = '$id'";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        die("Error deleting purchase record: " . mysqli_error($db));
    }
    header("Location: manage.php");
    exit();
}

if (isset($_POST['save_changes'])) {
    $id = $_GET['id'];
    $new_event_title = mysqli_real_escape_string($db, $_POST['event']);
    $new_qty = $_POST['qty'];
    $new_phone =$_POST['num'];
    $sql = "UPDATE ticket SET events = '$new_event_title', qty = '$new_qty', phone_num = '$new_phone' WHERE ticket_id = '$id'";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        die("Error updating purchase record: " . mysqli_error($db));
    }
    header("Location: manage.php");
    exit();
}

// retrieve the list of events for the dropdown menu
$sql = "SELECT event_title FROM event";
$result = mysqli_query($db, $sql);

if (!$result) {
    die("Error retrieving events information: " . mysqli_error($db));
}

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['event_title'] == $event_name) {
        $options .= "<option value=\"" . $row['event_title'] . "\" selected>" . $row['event_title'] . "</option>";
    } else {
        $options .= "<option value=\"" . $row['event_title'] . "\">" . $row['event_title'] . "</option>";
    }
}

// close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Edit Purchase Record</title>
	<link rel="stylesheet" href="editticket.css">
</head>

<body>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<?php include('header1.php'); ?>
	<div id="formLayout">
		<div id="form-container">
			<h1>Edit Purchase Record</h1>
			<form action="editticket.php?id=<?php echo $id; ?>"
				method="POST">
				<table cellspacing="0" cellpadding="5">
					<tr>
						<td> <label for="student id">Student ID:</label></td>
						<td><input type="text" name="student id" id="student id"
								value="<?php echo $student_id; ?>"
								disabled /></td>
					</tr>
					<tr>
						<td><label for="name">Student Name:</label></td>
						<td> <input type="text" name="name" id="name"
								value="<?php echo $name; ?>"
								disabled /></td>
					</tr>
					<tr>
						<td><label for="num">Phone Number:</label></td>
						<td><input type="text" name="num" id="num"
								value="<?php echo $phone; ?>" /></td>
					</tr>
					<tr>
						<td><label for="event">Event Title:</label></td>
						<td><select name="event" id="event">
								<?php echo $options; ?>
							</select></td>
					</tr>
					<tr>
						<td><label for="qty">Quantity:</label></td>
						<td><input type="number" name="qty" id="qty" min="1" max="8"
								value="<?php echo $qty; ?>"
								required /></td>
					</tr>
				</table>
				<input type="submit" name="save_changes" value="Save Changes">
				<input type="submit" name="delete" value="Delete"
					onclick="return confirm('Are you sure you want to delete this purchase record?')">
			</form>
		</div>
	</div>
</body>
<?php //include('footer1.php');?>

</html>