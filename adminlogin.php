<html>
<style>
	body {
		background-position: center;
		background-size: 100% 100%;

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

	fieldset {
		background-color: #bca5e1;
		color: #000000;
		border: none;
		border-radius: 5px;
		margin: 150px auto;
		padding: 40px;
		max-width: 400px;
	}

	legend {
		font-size: 24px;
		font-weight: bold;
		text-align: center;
		margin-bottom: 20px;
	}

	label {
		display: inline-block;
		width: 150px;
		margin-right: 10px;
		font-weight: bold;
	}

	input[type="text"],
	input[type="password"] {
		display: block;
		margin-bottom: 10px;
		padding: 10px;
		width: 100%;
		border-radius: 20px;
		border: 4px solid #ccc;
	}

	input[type="submit"],
	input[type="button"] {
		display: inline-block;
		padding: 10px 20px;
		margin-top: 10px;
		background-color: #7e5bd6d0;
		color: #ffffff;
		border-radius: 5px;
		border: none;
		cursor: pointer;
	}

	input[type="submit"]:hover,
	input[type="button"]:hover {
		background-color: #93dceb;
		color: #FFFFFF;
	}

	.error {
		color: #d01515;
		font-weight: bold;
		margin-top: 5px;
	}

	.error-message {
		color: red;
		text-align: center;
		font-weight: bold;
		font-size: 30px;
	}

	legend.admin {
		font-size: 25px;
		font-weight: bold;
		padding: 0.5em;
		border: 1px;
		border-radius: 5px;
		background-color: rgb(231, 170, 247);
		margin-bottom: 10px;
		box-shadow: 0px 0px 10px #e8ff38;
		text-align: center;
	}
</style>
<?php
require_once('adminhelper.php');
function htmlId($name, $value = '', $maxlength = '')
{
    printf(
        '<input type="text" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
        $name,
        $name,
        $value,
        $maxlength
    );
}

function htmlPassword($name, $value = '', $maxlength = '')
{
    printf(
        '<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
        $name,
        $name,
        $value,
        $maxlength
    );
}

function error()
{
    global $id, $password;
    $error = array();

    //for verify Admin ID
    if ($id == null) {
        $error["id"] = 'Please enter <strong>Admin ID</strong>.';
    } elseif (!preg_match('/^[T][A][R]\d{4}$/', $id)) {
        $error["id"] = 'Invalid!<strong>Admin ID</strong> should be in format: TARXXXX.';
    }

    //for verify password
    if ($password == null) {
        $error["password"] = 'Please enter <strong>Password</strong>.';
    }

    return $error;
}
?>

<head>
	<meta charset="UTF-8">
</head>

<body>
	<?php //include('header1.php');?>
	<video autoplay muted loop>
		<source src="/assignment/picture/purple3.mp4" type="video/mp4">
	</video>
	<fieldset>
		<legend class="admin">Admin Login</legend>
		<?php
        if (!empty($_POST)) {
            $id       = strtoupper(trim($_POST['id']));
            $password = trim($_POST['password']);
        }

        $error = error();
?>
		<form action="" method="post">
			<table>
				<tr>
					<td><label for="id">Admin ID :</label></td>
					<td>
						<?php htmlId('id', $id ?? '', 7)?>
					</td>
					<td>
						<?php if (!empty($error['id'])) {
						    echo '<span class="error">' . $error['id'] . '</span>';
						}?>
					</td>
				</tr>

				<tr>
					<td><label for="password">Password :</label></td>
					<td>
						<?php htmlPassword('password') ?>
					</td>
					<td>
						<?php if (!empty($error['password'])) {
						    echo '<span class="error">' . $error['password'] . '</span>';
						}
?>
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Submit" />

			<input type="button" value="Reset"
				onclick="location='<?php echo $_SERVER["PHP_SELF"] ?>'" />
			<input type="button" value="Back" onclick="location='index.php'" />

	</fieldset>
	</form>
</body>

</html>