<?php
//start the session.
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

    if($_SESSION['loggedIn'] === true){
        echo "welcome user <br>";
        echo $_SESSION['userDetails']['id']. "<br>";
        echo $_SESSION['userDetails']['first_name']. "<br>";
        echo $_SESSION['userDetails']['last_name']. "<br>";
        echo $_SESSION['userDetails']['email']. "<br>";
    }
    else{
        header('locaation:login.php');
    }

    ?>
    <a href="logout.php">logout</a>
</body>
</html>