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
		color: white;
		font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
	}
	a:hover{
		text-decoration: underline;;
	}
</style>
<header>
	<div id="header">
		<div id="logo"><img id="tarumt" src="picture/tarumt.png" alt="logo" /></div>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="event.php">Event</a></li>
				<li><a href="history.php">Purchase History</a></li>
				<li><a href="buy.php">Purchase Ticket</a></li>
				<li><a href="login.php">Log-in</a></li>
				<li><a href="register.php">Register</a></li>
			</ul>
		</nav>
	</div>
</header>