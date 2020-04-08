<?php
   include('session.php');
?>
<html lang="en-UK">

<head>
    <title>a chat box</title>
    <link rel='icon' href='chatboxfavicon.ico' type='image/x-icon'/ >
    <link rel='stylesheet' href='styles.css'>
</head>

<body>
    <h1>Welcome <?php echo $login_session; ?></h1>
    <a href = "logout.php">Sign Out</a>
</body>

</html>
