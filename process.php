<!DOCTYPE html>
<html>
    <body>
        <?php
            session_start();
            define('USER', 'root');
            define('PASSWORD', '');
            define('HOST', 'localhost');
            define('NAME', 'assignment');

            $db = mysqli_connect(HOST, USER, PASSWORD, NAME);

            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $name = $_POST['name'];
            $id = $_SESSION['student_id'];
            $course = $_POST['course'];
            $class = $_POST['class'];
            $phone = $_POST['phone'];
            $event = mysqli_real_escape_string($db, $_POST['event']);
            $qty = $_POST['qty'];

            $sql_check = "SELECT * FROM ticket WHERE student_id = '$id'";
            $result = mysqli_query($db, $sql_check);

            $sql_insert = "INSERT INTO ticket (student_name, student_id,course,class, phone_num, events, qty) VALUES ('$name', '$id','$course', '$class','$phone', '$event', '$qty')";
            if (mysqli_query($db, $sql_insert)) {
                header("Location: success.php");
                exit();
            } else {
                echo "Error: " . $sql_insert . "<br>" . mysqli_error($db);
            }
        ?>
    </body>
</html>