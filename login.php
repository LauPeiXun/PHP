<?php
    $student_id = $password = "";
    $password_error = "";
    $error=array();

    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('NAME', 'assignment');

    $con = mysqli_connect(HOST, USER, PASSWORD, NAME);

    if (!empty($_POST)) {
        $password = trim($_POST['password']);
        $student_id = trim($_POST['student_id']);
        $error = detectError();

        if (empty($error)) {
            if (isset($_POST['login'])) {
                $student_id = $_POST['student_id'];
                $password = $_POST['password'];

                $stmt = $con->prepare("SELECT * FROM participant WHERE student_id = ? AND password = ?");
                $stmt->bind_param("ss", $student_id, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    // Set the session data
                    session_start();
                    $_SESSION['student_id'] = $_POST['student_id'];

                    if(isset($_SESSION['student_id'])) {
                        // Redirect
                        echo "<script>alert('Hi! " . htmlspecialchars($student_id) . " successfully logined enjoy your browse.');</script>";
                        echo "<script>window.location.href = 'event.php';</script>";
                        exit();
                    }
                } else { // Unsuccessful
                    $error["student_id"] = "Invalid student id or password.";
                }
                mysqli_close($con);
            }
        }
    }

    function detectError()
    {
        // Use the global variables
        global $password, $student_id;
        $error=array();

        // student id
        if ($student_id == null) {
            $error["name"] = 'Please enter <strong>Stuent ID</strong>.';
        }

        // password
        if ($password == null) {
            $error["password"] = 'Please enter <strong>Password</strong>.';
        }

        return $error;
    }

    function htmlInputPassword($name, $value = '', $maxlength = '')
    {
        printf('<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" required />' . "\n", $name, $name, $value, $maxlength);
    }

    function htmlInputText($student_id, $value = '', $maxlength = '')
    {
        printf('<input type="text" name="%s" id="%s" value="%s" maxlength="%s" required />' . "\n", $student_id, $student_id, $value, $maxlength);
    }
?>

<html>
    <head>
        <title>Login Page</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <?php include('header.php'); ?>
        <h1 id="login">Log-in</h1>
        <form id="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Student ID: </label>
            <?php htmlInputText('student_id', $student_id ?? '', 30) ?>
            <br>
            <label for="password">Password: </label>
            <?php htmlInputPassword('password', $password ?? '', 15) ?>
            <p>
                <?php
                echo '<ul class="error">';
                foreach ($error as $value) { echo "<li>$value</li>"; }
                echo '</ul>';
                ?>
            </p>
            <p style=" font-size: smaller;">don't have an account?
                <a href="register.php" id="switch" style="color: darkmagenta;">click here</a>
            </p>
            <input type="submit" name="login" value="log-in">
        </form>
    </body>
    <?php include('footer.php'); ?>
</html>