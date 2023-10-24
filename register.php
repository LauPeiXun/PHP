<?php
define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('NAME', 'assignment');

$con = mysqli_connect(HOST, USER, PASSWORD, NAME);
$name = $password = $email = "";
$password_error = "";
$error;
$file;
$error=array();

//register account and store in database
if (!empty($_POST)) {
    $password = trim($_POST['password']);
    $confirm  = trim($_POST['cpassword']);
    $student_id = trim($_POST['student_id']);
    $email = trim($_POST['email']);
    $file = $_FILES['file'];

    $error = detectError();
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (empty($error)) {
        $con = mysqli_connect(HOST, USER, PASSWORD, NAME);
        $save_as = uniqid() . '.' . $ext;
        move_uploaded_file($file['tmp_name'], '/xampp/htdocs/assignment/picture/' .$save_as);
        $q ="INSERT INTO participant (`student_id`, `email`, `password`, `profile_pic`) VALUES ('$student_id', '$email', '$password', '$save_as')";
        $result = mysqli_query($con, $q);

        if ($result) {
            echo "<script>alert('Hi! " . htmlspecialchars($student_id) . " are successfully registered, you can Log In or enjoy your browse.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }

        $password = $confirm = $student_id = $email=$file = null;

    }
}

function htmlInputPassword($name, $value = '', $maxlength = '')
{
    printf('<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" required />' . "\n", $name, $name, $value, $maxlength);
}

function htmlInputMail($name, $value = '', $maxlength = '')
{
    printf('<input type="email" name="%s" id="%s" value="%s" maxlength="%s" required />' . "\n", $name, $name, $value, $maxlength);
}

function htmlInputText($student_id, $value = '', $maxlength = '')
{
    printf('<input type="text" name="%s" id="%s" value="%s" maxlength="%s" required />' . "\n", $student_id, $student_id, $value, $maxlength);
}

//error function
function detectError()
{
    global $password, $confirm, $student_id,$email,$file,$ext,$con;
    $error =array();

    //check for duplicate
    $q ="SELECT * FROM participant WHERE student_id = '$student_id'";
    $r = mysqli_query($con, $q);
    $row = $r->fetch_object();

    // studen id
    if (strlen($student_id) > 20) {
        $error["name"] = '<span class="error"><strong>Student ID</strong> must not more than 20 letters.</span>';
    } elseif (!preg_match('/^[0-9]+$/', $student_id)) {
        $error["name"] = '<span class="error">There are invalid letters in <strong>Student ID</strong>.</span>';
    } elseif ($row && strcmp($row->student_id, $student_id)==0) {
        $error["name"] = '<span class="error">This student id already exist please change student id</span>';
    }

    // email
    if (strlen($email) > 50) {
        $error["email"] = '<span class="error"><strong>Email Address</strong> must not more than 30 characters.</span>';
    } elseif (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email)) {
        $error["email"] = '<span class="error"><strong>Email Address</strong> is of invalid format.</span>';
    }

    // password
    if (strlen($password) < 8 || strlen($password) > 15) {
        $error["password"] = '<span class="error"><strong>Password</strong> must between 8 to 15 characters.</span>';
    } elseif (!preg_match('/^\w+$/', $password)) {
        $error["password"] = '<span class="error"><strong>Password</strong> must contain only alphabet, digit and underscore.</span>';
    }

    // confirm
    if ($confirm != $password) {
        $error["confirm"] = '<span class="error"><strong>Confirm Password</strong> must match the password.</span>';
    }

    //check for image file
    if ($file['size'] == null) {
        $error["file"] = '<span class="error">Please upload a <strong>picture</strong> as your profile picture.</span>';
    } elseif ($file['size'] > 1048576) {
        $error["file"] = '<span class="error">File size too large.</span>';
    } elseif($ext != 'jpg'  && $ext != 'jpeg' && $ext != 'gif'  && $ext != 'png' && $ext != null) {
        $error["file"] = '<span class="error">Only JPG, GIF and PNG format are allowed.</span>';
    }
    mysqli_close($con);

    return $error;
}
?>

<html>

<head>
	<title>Register Page</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="register.css">
</head>

<body>
	<?php include('header.php'); ?>
	<h1 id="register">Register</h1>
	<form id="register" method="post"
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
		enctype="multipart/form-data">
		<label for="username">Student ID: </label>
		<?php htmlInputText('student_id', $student_id ?? '', 30) ?>
		<label for="email">Email: </label>
		<?php htmlInputMail('email', $email ?? '', 35) ?>
		<label for="password">Password: </label>
		<?php htmlInputPassword('password', $password ?? '', 15) ?>
		<label for="cpassword">Confirm Password: </label>
		<?php htmlInputPassword('cpassword', $confirm ?? '', 15) ?>
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<label for="file">Profile Picture: </label>
		<input type="file" name="file" id="file" />
		<div class="error">
			<?php
                    if (!empty($error)) {
                        echo '<ul>';
                        foreach ($error as $err) {
                            echo '<li>' . $err . '</li>';
                        }
                        echo '</ul>';
                    }
?>
		</div>
		<p style="font-size: smaller;">already have an account? <a href="login.php" style="color: darkmagenta;">click
				here</a></p>
		<input type="submit" name="register" value="register">
	</form>
	<?php include('footer.php'); ?>
</body>

</html>