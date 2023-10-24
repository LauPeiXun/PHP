<?php
session_start();
?>

<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'assignment');

if (isset($_POST['submit'])) {
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "SELECT * FROM admininfo";
    $result = $con->query($sql);
    $row = $result->fetch_object();
    {
        if (strcmp($row->adminid, $_POST['id']) == 0 && strcmp($row->password, $_POST['password']) == 0) {
            header("Location: adminchoose.php");
        } else {
            $error = 'Wrong Password or ID, enter again';
            echo '<span class="error-message">' . $error . '</span>';

        }
    }
}
?>