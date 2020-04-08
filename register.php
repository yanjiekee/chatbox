<!DOCTYPE html>
<?php
    include("config.php");
    session_start();
    define("SECRETCODE", "youaremysunshine");

    function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function emailVerification($email) {
        $randomNum = mt_rand(0, 99999);
        $randomCode = str_pad((string)($randomNum), 5, "0", STR_PAD_LEFT);
        $msg = "Your verification code is ".$randomCode.". Thank you for registrating!";
        mail($email, "an email verfication", $msg);
        return $randomCode;
    }

    $newUsername = $newPassword = $newEmail = $secretCodeInput = "";
    $newUsernameErr = $newPasswordErr = $newEmailErr = $secretCodeInputErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["newusername"])) {
            $newUsernameErr = "Must be filled";
        } else {
            $newUsername = testInput($_POST["newusername"]);
            if (!preg_match("/^[a-zA-Z]*$/",$newUsername)) {
                $newUsernameErr = "Only letters allowed";
            }
        }

        if (empty($_POST["newpassword"])) {
            $newPasswordErr = "Must be filled";
        } else {
            $newPassword = testInput($_POST["newpassword"]);
            if (strlen($newPassword) < 5) {
                $newPasswordErr = "Password must > 4 digits";
            }
        }

        if (empty($_POST["newemail"])) {
            $newEmailErr = "Must be filled";
        } else {
            $newEmail = testInput($_POST["newemail"]);
            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                $newEmailErr = "Invalid email format";
            }
        }

        if (empty($_POST["secretcodeinput"])) {
            $secretCodeInputErr = "Must be filled";
        } else {
            $secretCodeInput = testInput($_POST["secretcodeinput"]);
            if (strcmp($secretCodeInput, SECRETCODE)) {
                $secretCodeInputErr = "Nice try bud.";
            }
        }
    }
?>
<html lang="en-UK">

<head>
    <title>a chat box</title>
    <meta charset="UTF-8">
    <link rel='icon' href='chatboxfavicon.ico' type='image/x-icon'/ >
    <link rel='stylesheet' href='styles.css'>
    <script src = 'showpassword.js'></script>
</head>

<body>
    <h1>Registration</h1>

    <div class="form">
        <form method="post" action="" autocomplete="off">
            New username : <input type="text" name="newusername"
            value = "<?php echo $newUsername?>">
            <span class="error"><?php echo $newUsernameErr ?></span></br>
            New password : <input type="password" name="newpassword" id="passwordInput"
            value = "<?php echo $newPassword?>">
            <span class="error"><?php echo $newPasswordErr ?></span></br>
            Email address : <input type="text" name="newemail"
            value = "<?php echo $newEmail?>">
            <span class="error"><?php echo $newEmailErr ?></span></br>
            Secret code : <input type="text" name="secretcodeinput"
            value = "<?php echo $secretCodeInput?>">
            <span class="error"><?php echo $secretCodeInputErr ?></span></br></br>
            <input type="checkbox" onclick="passwordVisibility()">
            <span class="sideelement">Show password</span></br></br>
            <input type="submit" value="Register"></br></br>
        </form>
    </div>
    <a href="index.php">back to homepage</a>

</body>

</html>
