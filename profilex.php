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

    <link rel="stylesheet" type="text/css" href="css/navigation1.css">


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
        header('locaation:login.php');
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
                <li><a href="login.php">LOGOUT</a></li>
               
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
                        <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                        <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                    </div>
                </div>
        </div>


</body>
</html>