<!DOCTYPE html>
<?php
    include("config.php");
    session_start();

    function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = $password = "";
    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $myusername = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT salt FROM user WHERE username = '$myusername'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $salt = $row['salt'];

        $mypassword = sha1($_POST['password'].$salt);

        $query = "SELECT id FROM user WHERE username = '$myusername' AND hashedpassword = '$mypassword'";
        $result = mysqli_query($conn, $query);
        // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // $active = $row['active'];

        $count = mysqli_num_rows($result);
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1) {
            //session_register("myusername");
            $_SESSION['login_user'] = $myusername;

            header("location: welcome.php");
        } else {
            $errorMessage = "Your Login Name or Password is invalid";
        }
    }
?>
<html lang="en-UK">

<head>
    <title>a chat box</title>
    <meta charset='UTF-8'>
    <link rel='icon' href='chatboxfavicon.ico' type='image/x-icon'/ >
    <link rel='stylesheet' href='styles.css'>
    <script src='homepage.js'></script>
</head>

<body onload = "startTime(); dayOfTheWeek();">
    <h1>How was your <span id="whatday"></span>?</h1>
    <p>Take a step back and think for a bit.. Happy chatting!</p>
    <p>It's currently <span id="digitalclock"></span>.</p>

    <div class="form">
        <form method="post" action="" autocomplete="off">
            Username : <input type="text" name="username"></br>
            Password : <input type="password" name="password"></br>
            <span class="error"><?php echo $errorMessage ?></span></br></br>
            <input type="submit" value="Sign In"></br></br>
        </form>
    </div>
    <a href="register.php">or register here</a>

</body>

</html>
