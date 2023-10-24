<?php
// start session
session_start();

define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('NAME', 'assignment');

// function that checks if user is logged in
function checkLoggedIn()
{
    if (!isset($_SESSION['student_id'])) {
        echo "<script>alert('Please kindly log-in first.');</script>";
        // header("Location: login.php");
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
}

// check if user is logged in
checkLoggedIn();

// connect to the database
$db = new mysqli(HOST, USER, PASSWORD, NAME);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// retrieve purchase history for current student
$student_id = $_SESSION['student_id'];
$sql = "SELECT ticket.ticket_id, ticket.student_name,ticket.student_id, ticket.phone_num,participant.email, event.event_title AS event_name, ticket.qty
          FROM ticket
          INNER JOIN event ON ticket.events = event.event_title JOIN participant ON ticket.student_id = participant.student_id
          WHERE ticket.student_id = '$student_id'";
  $result = mysqli_query($db, $sql);

  if (!$result) {
    die("Error retrieving purchase history: " . mysqli_error($db));
  }

  // close the database connection
  mysqli_close($db);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Purchase History</title>
    <link rel="stylesheet" href="history.css">
  </head>
  <body>
    <?php include('header.php'); ?>
    <div id="historyLayout">
      <div id="history-container">
        <h1>Purchase History</h1>
        <?php if ($result->num_rows > 0): ?>
        <table>
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Event Type</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['student_name']; ?></td>
              <td><?php echo $row['phone_num']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['event_name']; ?></td>
              <td><?php echo $row['qty']; ?></td>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			<?php else: ?>
			<p style="color:white; font-size:30px; font-weight:bold; text-align:center;">No purchase history found.</p>
			<?php endif; ?>
		</div>
	</div>
</body>
<?php include('footer.php'); ?>
</html>