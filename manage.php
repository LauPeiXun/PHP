<?php
session_start();
?>
<style>
	/* Set body background */
	body {
		background-position: center;
	}

	video {
		/* position: absolute; */
		right: 0;
		bottom: 0;
		min-width: 100%;
		min-height: 100%;
		z-index: -1;
		object-fit: cover;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		overflow: hidden;
	}


	/* Add some padding to the header */
	header {
		background-color: #5e6eff;
		color: white;
		text-align: center;
		margin-bottom: 30px;
		width: 100%;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
	}

	div#form {
		text-align: center;
	}

	form {
		margin: 10px auto;
		display: inline-block;
	}

	input[type="submit"] {
		display: inline-block;
		padding: 10px 20px;
		background-color: #5c246e;
		color: #fff;
		border: none;
		cursor: pointer;
		border-radius: 10px;
	}

	input[type="text"] {
		display: inline-block;
		width: 60%;
		padding: 10px;
		margin-bottom: 10px;
		border: none;
		background-color: #f5eefc;
		color: #333;
		border-radius: 10px;
	}

	input[type="submit"]:hover {
		background-color: #7cbad0;
	}

	/* Style the table */
	table {
		border-collapse: collapse;
		width: 100%;
		max-width: 800px;
		background-color: #fff;
		border-radius: 5px;
		overflow: hidden;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
		margin: 0 auto;
	}

	th,
	td {
		text-align: left;
		padding: 12px;
		border-bottom: 1px solid #ddd;
	}

	th {
		background-color: #85b7fc;
		color: white;
		font-weight: bold;
		text-transform: uppercase;
	}

	tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	p {
		text-align: center;
		color: black;
		font-size: 30px;
		font-weight: bold;
	}
</style>

<html>
<meta charset="UTF-8">
<img src="picture/arrow.png" alt="back" usemap="#backmap" style="width:65px;height:55px;" />
<map name="#backmap">
	<area shape="rect" coords="0,0,107,99" alt="back" href="adminchoose.php">
</map>
<img src="picture/logout.png" alt="back" usemap="#logoutmap" class="logout"
	style="  position: absolute;top: 10px;right: 10px;width: 85px;height: 70px;">
<br>
<map name="#logoutmap">
	<area shape="rect" coords="0,0,1780,120" alt="logout" href="adminlogout.php">
</map>

<body>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<br>
	<header>
		<h1>Manage the Ticket </h1>
	</header>
	<div id="form">
		<form method="POST">
			<input type="text" id="search" name="search" placeholder="Enter student ID">
			<input type="submit" name="submit" value="Search">
		</form>
	</div>


	<?php
define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('NAME', 'assignment');

if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $con = new mysqli(HOST, USER, PASSWORD, NAME);
        $sql = "SELECT * FROM ticket WHERE student_id = '$search'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo '<table>
                    <thead>
                    <tr>
                    <th>Manage Ticket</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Phone Number</th>
                    <th>Event</th>
                    <th>Seat Quantity</th>
                    </tr>
                    </thead>
                    <tbody>';
            while ($row = $result->fetch_object()) {
                printf(
                    '
                             <tr>
                                 <td><a href="editticket.php?id=%s">Click here to manage the ticket information!</a></td>
                                 <td>%s</td>
                                 <td>%s</td>
                                 <td>%s</td>
                                 <td>%s</td>
                                 <td>%s</td>
                             </tr>',
                    $row->ticket_id,
                    $row->student_id,
                    $row->student_name,
                    $row->phone_num,
                    $row->events,
                    $row->qty
                );
            }

            echo '</tbody>
             </table>
             </br>';
        } else {
            echo "<p>No results found.</p>";
        }
    }
}
?>
	<?php
$PAGE_TITLE = 'NewEvent';
$con = new mysqli(HOST, USER, PASSWORD, NAME);
$sql = "SELECT * FROM ticket";
if ($result = $con->query($sql)) {
    echo '<table>
            <thead>
              <tr>
                <th>Manage Ticket</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Phone Number</th>
                <th>Event</th>
                <th>Seat Quantity</th>
              </tr>
            </thead>
            <tbody>';
    while ($row = $result->fetch_object()) {
        printf(
            '
                   <tr>
                       <td><a href="editticket.php?id=%s">Click here to manage the ticket information!</a></td>
                       <td>%s</td>
                       <td>%s</td>
                       <td>%s</td>
                       <td>%s</td>
                       <td>%s</td>
                   </tr>',
            $row->ticket_id,
            $row->student_id,
            $row->student_name,
            $row->phone_num,
            $row->events,
            $row->qty
        );
    }

    echo '</tbody>
           </table>';
}
mysqli_close($con);
?>
</body>
<?php //include('footer1.php');?>

</html>