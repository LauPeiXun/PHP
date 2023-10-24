<style>
	#tarumt {
		height: 70px;
		width: 300px;
	}

	#header {
		display: flex;
		align-items: center;
		padding: 15px;
		height: 70px;
		width: auto;
	}

	nav {
		flex: 1;
		text-align: right;
	}

	nav ul {
		display: inline-block;
		list-style-type: none;
	}

	nav ul li {
		display: inline-block;
		margin-right: 20px;
	}

	a {
		border: none;
		text-decoration: none;
		color: black;
		font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
	}

	a:hover {
		color:black;
		text-decoration: underline;;
	}
</style>
<header>
	<div id="header">
		<div id="logo"><img id="tarumt" src="picture/tarumt.png" alt="logo" /></div>
		<nav>
			<ul>
			<li><a href="index.php">Home</a></li>
				<li><a href="adminchoose.php">Option</a></li>
				<li><a href="display.php">Event Info</a></li>
                    <li><a href="addevent.php">Add Event</a></li>
				<li><a href="edit.php">Edit event</a></li>
				<li><a href="updateseat.php">Update Seat</a></li>
			</ul>
		</nav>
	</div>
</header>