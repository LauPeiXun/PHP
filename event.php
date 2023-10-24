<html>

<head>
	<title>Browse for event</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="event.css">
</head>
<?php
        define('USER', 'root');
        define('PASSWORD', '');
        define('HOST', 'localhost');
        define('NAME', 'assignment');
$con = mysqli_connect(HOST, USER, PASSWORD, NAME);

session_start();
if (isset($_SESSION['student_id'])) {
    $loginName = $_SESSION['student_id'];
} else {
    $loginName = null;
}

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if search button is clicked
if (isset($_POST['Search'])) {
    $eventS = $_POST['search'];
    $q ="SELECT * FROM event WHERE event_title = '$eventS'";
    $r = mysqli_query($con, $q);
    $row = $r->fetch_object();
    if ($row && strcmp($row->event_title, $eventS)==0) {
        $link = '#' . $eventS;
        header('Location: ' . $link);
        exit;
    }
}

// Check if sort button is clicked
if (isset($_POST['sort'])) {
    $sortColumn = $_POST['sortColumn'];   // Get the column to sort from the form
    $sortOrder = $_POST['sortOrder'];    // Get the sort order ASC or DESC from the form

    // Modify the SQL query to include sorting
    $sql = "SELECT * FROM event ORDER BY $sortColumn $sortOrder";
} else {
    $sql = "SELECT * FROM event";
}

if (isset($_POST['logout'])) {

    if (!isset($_SESSION['student_id'])) {
        echo "<script>alert('Warning! No permission allowed.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    } else { // Cancel the session.
        $_SESSION = array(); // Clear variables
        session_destroy(); // Destroy session
        setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy cookie
        echo "<script>alert('Bye! You are successfully log out see you soon.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }
}
$result = mysqli_query($con, $sql);
?>

<body>
	<?php include('header.php'); ?>
	<div class="search-event">
		<form id="search" method="post"
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="text" name="search" id="search" placeholder=" event title" maxlength="50"><input type="submit"
				value="Search" name="Search">
			<select class="sort_column" name="sortColumn">
				<option value="event_title">Event Title</option>
				<option value="genre">Genre</option>
				<option value="place">Venue</option>
				<option value="seat">Seat</option>
			</select>
			<select class="sort_style" name="sortOrder">
				<option value="ASC">ASC</option>
				<option value="DESC">DESC</option>
			</select>
			<input type="submit" value="Sort" name="sort">
			<div id="profile-pic-container">
				<?php
                        $query ="SELECT student_id,profile_pic FROM participant WHERE student_id = '$loginName'";
$stt = mysqli_query($con, $query);
$statement = $stt->fetch_object();
?>
				<div id="user">
					<?php
    if ($statement && strcmp($statement->student_id, $loginName)==0) {
        echo '<img id="picture" src="/assignment/picture/'.$statement->profile_pic.'">';
    } else {
        echo '<img id="picture" src="/assignment/picture/default pic.jpeg">';
    }
    if($loginName !== null) {
        echo '<p id="displayname">'. $loginName.'</p>';
    } else {
        echo '<p id="displayname">Visitor</p>';
    }
?>
				</div>
				<input type="submit" value="Log Out" name="logout" id="profile" style="margin-left: 40px;">
			</div>
		</form>
	</div>
	<?php
            echo '<div class="event-container">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="event-item">';
    echo '<img src="/assignment/picture/'.$row['image'].'">';
    echo '<div class="event-details">';
    echo '<h2 id="'.$row['event_title'].'">'.$row['event_title'].'</h2>'.'<p> '.$row['event_description'].'</p>'.'<ul>'.'<li><strong>Price: RM </strong>'.$row['price'].'</li>'.'<li><strong>Genre:</strong>'.$row['genre'].'</li>'.'<li><strong>Venue:</strong>'.$row['place'].'</li>'.'<li><strong>Seat Remain:</strong>'.$row['seatremain'].'/'.$row['seat'].'</li>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
mysqli_close($con);
include('footer.php');
?>
</body>

</html>