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
    $fnameErr=$lnameErr=$emailErr=$passErr="";
    $fname=$lname=$email=$pass="";
    $status=true;
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="blog";

    if (!empty($_POST)) {
        
        if(empty($_POST['fname'])){
            $fnameErr="first name is empty";
            $status=false;
        }
         else{
        echo "first Name:" .$_POST['fname']."<br>";
        $fname=$_POST['fname'];

        }
        
        if(empty($_POST['lname'])){
            $lnameErr="last name is empty";
            $status=false;

        }
        else{
            echo "last Name:" .$_POST['lname']."<br>";
            $lname=$_POST['lname'];

        }
        
        if(empty($_POST['email'])){
            $emailErr="email is empty";
            $status=false;

        }
        else{
            echo "email:" .$_POST['email']."<br>";
            $email=$_POST['email'];

        }
        if(empty($_POST['pass'])){
            $passErr="password is empty";
            $status=false;

        }
        else{
            echo "password:" .$_POST['pass']."<br>";
            $pass=$_POST['pass'];
            $pass=sha1($pass);
        }
       
        if($status){
            // create new conection
            $conn = new mysqli($servername,$username,$password,$dbname);
    
            // check connection
            if($conn->connect_error){
                die("connection falied" . $conn->connect_error);
            }
            
            else{
            $sql= "INSERT into users (first_name,last_name,email,password) values('$fname','$lname','$email','$pass')";
    
                if($conn-> query($sql)) {
                        echo "new record created successfully.";
                }
                else{
                    echo "error" .$sql. "<br>" . $conn->error;
                }
    
                $conn->close();
            }
            // echo("connected successfully.")
        }

        }
    
    ?>

    <form action="" method="post">
    firstname:<input type="text" name="fname" id="fname" value="<?php echo $fname;?>" ><br>
    <p><?php echo $fnameErr;?></p>
    <br>
    lastname:<input type="text" name="lname" id="lname" value="<?php echo $lname;?>" ><br>
    <p><?php echo $lnameErr;?></p>
    <br>
    email:<input type="email" name="email" id="email" value="<?php echo $email;?>" ><br>
    <p><?php echo $emailErr;?></p>
    <br>
    password:<input type="password" name="pass" id="pass" value="<?php echo $pass;?>" ><br>
    <p><?php echo $passErr;?></p>
    <br>
    <input type="submit" value="submit" name="submit">
    </form>


    
</body>
</html>