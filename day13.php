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
        $servername="localhost";
        $username="root";
        $password="";

        // create new conection
        $conn = new mysqli($servername,$username,$password);

        // check connection
        if($conn -> connect_error){
            die("connection falied" . $conn -> connect_error);
        }
        echo("connected successfully.")
    ?>
</body>
</html>