<!DOCTYPE html>
<html>

<head>
	<title>Footer</title>
</head>

<body>
	<style>
		#footer {
			background-color: black;
			color: white;
			padding: 20px;
			margin-top: 30px;
		}

		/* #footerGen {
			margin-top: 100px;
			background-color: black;
			color: white;
			height: 200px;
			width: 100%;
		} */

		#footer {
			display: flex;
			justify-content: space-around;
		}

		#ig,
		#fb {
			height: 30px;
			width: 30px;
			border-radius: 10px;
		}
	</style>
	<footer>
		<div id="footer">
			<div id="ticket">
				<p><b>Tikcet</b></p>
				<br>
				<a href="manage.php">Manage Ticket</a>
				<br><br><br>
				<a href="changepassword.php">Password</a>
			</div>
			<div id="event">
				<p><b>Event</b></p>
				<br>
				<a href="edit.php">Edit Event</a>
				<br><br><br>
				<a href="history.php">View Event</a>
			</div>
			<div id="contact">
				<p><b>Contact Us</b></p>
				<br>
				<a href="https://www.instagram.com"><img src="picture/ig.jpg" id="ig" alt="ig"></a>
				<br><br>
				<a href="https://www.facebook.com"><img src="picture/fb.jpg" id="fb" alt="fb"></a>
			</div>
			<div id="map">
				<p><b>Location</b></p>
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.5366322029954!2d101.72591861744384!3d3.215557299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3843bfb6a031%3A0x2dc5e067aae3ab84!2sTunku%20Abdul%20Rahman%20University%20of%20Management%20and%20Technology%20(TAR%20UMT)!5e0!3m2!1sen!2smy!4v1680277407584!5m2!1sen!2smy"
					width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"></iframe>

			</div>
		</div>
	</footer>
</body>

</html>