<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'yanjiekee');
    define('DB_PASSWORD', NULL);
    define('DB_DATABASE', 'chatbox');
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
