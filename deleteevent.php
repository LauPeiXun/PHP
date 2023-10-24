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

// Retrieve the event name from the POST data
// Check if the event name parameter is set
if (!isset($_POST['event_id'])) {
    die("Event name parameter is missing.");
}

// Retrieve the event name from the POST data
$event_id = $_POST['event_id'];

// Delete the event from the database
$delete_query = "DELETE FROM event WHERE event_id='$event_id'";
if (mysqli_query($conn, $delete_query)) {
    echo "<script>alert('Event deleted successfully.');</script>";
    echo "<script>window.location.href = 'display.php';</script>";
} else {
    echo "Error deleting event: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
