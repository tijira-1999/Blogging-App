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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>YOUR PROFILE</title>

    <link rel="stylesheet" type="text/css" href="css/profilex.css">


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
        // echo "welcome user <br>";
        // echo $_SESSION['userDetails']['id']. "<br>";
        // echo $_SESSION['userDetails']['first_name']. "<br>";
        // echo $_SESSION['userDetails']['last_name']. "<br>";
        // echo $_SESSION['userDetails']['email']. "<br>";

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

        <!-- navbar -->

        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
              <a class="navbar-brand" href="#">Logo</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">YOU</a></li>
                <li><a href="#myModal" data-toggle="modal">CREATE POST</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
               
              </ul>
            </div>
          </div>
        </nav>

        <div class="container">
              <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">CREATE NEW POST</h4>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">

                            
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" placeholder="Enter Title" name="title" id="title">
                                <p><?php echo $titleErr;?></p>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="des">Description:</label>
                                <textarea  class="form-control" placeholder="Enter Description" name="des" id="des" rows="5"></textarea>
                                <p><?php echo $desErr;?></p>
                                <br>
                            </div>
                                 
                        
                        </div>
                        
                        <div class="modal-footer a">                        
                            <button type="submit" class="btn btn-success">Create</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                        </form>
                    </div>
                    
                    </div>
                </div>
        </div>

        <div class="left">
        <h1>Welcome</h1>
                <?php
                echo "<h2>".$_SESSION['userDetails']['first_name']." ".$_SESSION['userDetails']['last_name']."</h2>"
                ?>
            <div class="picimg">
            <img src="<?php echo $_SESSION['userDetails']['images'] ?>" height=100px width=100px alt="image">
            </div>
            <div class="about">
                
                <label>User name: </label>
                <?php
                echo "<p>".$_SESSION['userDetails']['user_name']."</p><br>";
                ?>

                <label>Email: </label>
                <?php
                echo "<p>".$_SESSION['userDetails']['email']."</p><br>";
                ?>
                <label>Phone No: </label>
                <?php
                echo "<p>".$_SESSION['userDetails']['phone']."</p><br>";
                ?>
                <ul><li><a class="logout" style="margin-left:36%;padding:5px;font-size: 1rem;" href="logout.php">Logout</a></li></ul>
                
            </div>
            <hr>
            <h3>Contact Us</h3>
            <ul>
                <li>
                    <a class="fa fa-facebook" href=" https://www.facebook.com/abhishek.ray.7771 "> Facebook</a></li>
                <li>
                    <a class="fa fa-twitter" href="https://twitter.com/abhishe15936339 ">Twitter</a></li>
                <li>
                    <a class="fa fa-linkedin" href=" https://www.facebook.com/abhishek.ray.7771 "> Linkedin</a></li>

            </ul>


        </div>
        <div class="image"></div>
        <div class="right">
            
            <h1 style="text-align:left;">My blogs..</h1>
            <?php
                if($status){
                    // create new conection
                    $conn = new mysqli($servername,$username,$password,$dbname);
                    $id=$_SESSION['userDetails']['id'];
                    $sql="SELECT title,description,post.created_date_time from post
                    inner join users on post.user_id=users.id where user_id=$id";
                    $postresult=$conn->query($sql);
                    echo "<div class='bb'>";
                    while($row=$postresult->fetch_assoc())
                    {
                    echo "<div class='b'>";
                    echo "<h2>".$row["title"]."</h2> <hr>";
                    echo "<pre>Created On:  " .$row["created_date_time"]."</pre>" ;
                    echo "<br><br>";
                    echo "<p>".$row["description"]."</p></div>";
                    
                    }
                    echo "</div>";

                $conn->close();
                }
            ?>
        </div>
        

<script>
    function x(){
        alert("new record created succesfully");
    }
</script>
</body>
</html>