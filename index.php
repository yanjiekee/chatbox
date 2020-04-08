<!DOCTYPE html>
<?php
    include("config.php");

    function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = $password = "";
    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $errorMessage = "Invalid username or password";
        } else {
            $username = testInput($_POST["username"]);
        }

        if (empty($_POST["password"])) {
            $errorMessage = "Invalid username or password";
        } else {
            $password = testInput($_POST["password"]);
        }
    }
?>
<html lang="en-UK">

<head>
    <title>a chat box</title>
    <meta charset='UTF-8'>
    <link rel='icon' href='chatboxfavicon.ico' type='image/x-icon'/ >
    <link rel='stylesheet' href='styles.css'>
</head>

<body>
    <?php echo "<h1>How is your ".date("l")."?</h1>"; ?>
    <p>Take a step back and think for a bit.. Happy chatting!</p></br>

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
