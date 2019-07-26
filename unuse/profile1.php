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
    $titleErr=$desErr="";
    $title=$des="";
    $status=true;
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="lecturenotes";


    if($_SESSION['loggedIn'] === true){
        echo "welcome user <br>";
        echo $_SESSION['userDetails']['id']. "<br>";
        echo $_SESSION['userDetails']['first_name']. "<br>";
        echo $_SESSION['userDetails']['last_name']. "<br>";
        echo $_SESSION['userDetails']['email']. "<br>";

        if (!empty($_POST)) {
               
            if(empty($_POST['title'])){
                $titleErr="email is empty";
                $status=false;
    
            }
            else{
                // echo "email:" .$_POST['email']."<br>";
                $title=$_POST['title'];
    
            }
            if(empty($_POST['des'])){
                $desErr="password is empty";
                $status=false;
    
            }
            else{
                // echo "password:" .$_POST['pass']."<br>";
                $des=$_POST['des'];
                // $pass=sha1($pass);
    
                    }
    
            
           
            if($status){
                // create new conection
                $conn = new mysqli($servername,$username,$password,$dbname);
        
                // check connection
                if($conn->connect_error){
                    die("connection falied" . $conn->connect_error);
                }
                
                else{
    
                $id=$_SESSION['userDetails']['id'];
                $sql= "INSERT into post (title,description,user_id) values('$title','$des','$id')";
                
                if($conn-> query($sql)) 
                {
                    echo "new record created successfully.";
                    // header('Location:login.php');
                }
                else
                {
                    echo "error" .$sql. "<br>" . $conn->error;
                }
                // echo $sql;
                $conn->close();
                
                }
                // echo("connected successfully.")
            }
    
        }

    }
    else{
        header('location:login.php');
    }

 
    
    ?>
   <img src="<?php echo $_SESSION['userDetails']['images'] ?>" height=100px width=100px alt="image">
    <form action="" method="post">
    Title:<input type="text" name="title" id="title" value="<?php echo $title;?>" ><br>
    <p><?php echo $titleErr;?></p>
    <br>
    Description:<textarea name="des" id="des" columns="10" rows="10" value="<?php echo $des;?>" ></textarea><br>
    <p><?php echo $desErr;?></p>
    <br>
    <input type="submit" value="create post" name="post">
    </form>

    <a href="logout.php">logout</a>

    <?php
    if($status){
        // create new conection
        $conn = new mysqli($servername,$username,$password,$dbname);
         $id=$_SESSION['userDetails']['id'];
         $sql="SELECT title,description from post
         inner join users on post.user_id=users.id where user_id=$id";
         $postresult=$conn->query($sql);
         while($row=$postresult->fetch_assoc())
        {
         echo "<div><h3>".$row["title"]."</h3>";
         echo "<p>".$row["description"]."</p></div>";
        }

     $conn->close();
    }
   ?>
    
</body>
</html>