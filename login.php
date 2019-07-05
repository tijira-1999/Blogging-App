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

    <title>login page</title>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <script type="text/javascript" src="javascript/login.js"></script>

 
</head>
<body>

<?php
    $emailErr=$passErr="";
    $email=$pass="";
    $status=true;
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="lecturenotes";

    if (!empty($_POST)) {
               
        if(empty($_POST['email'])){
            $emailErr="email is empty";
            $status=false;

        }
        else{
            // echo "email:" .$_POST['email']."<br>";
            $email=$_POST['email'];

        }
        if(empty($_POST['pass'])){
            $passErr="password is empty";
            $status=false;

        }
        else{
            // echo "password:" .$_POST['pass']."<br>";
            $pass=$_POST['pass'];
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

            $pass = sha1($pass);
            $sql= "SELECT id,first_name,last_name,email,images,user_name,phone from users where email='$email' and password='$pass'";
            $result=$conn->query($sql);
// echo $sql;
            

                if($result ->num_rows > 0) {
                    $record= $result->fetch_assoc(); //converting to an associative array.
                    
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['userDetails'] = $record;

                    echo $record['id']."<br>"; 
                    echo $record['first_name']."<br>"; 
                    echo $record['last_name']."<br>"; 
                    echo $record['email']."<br>";
                    // echo $record['email']."<br>";  
                    echo "login succesful";
                    header('location:profilex.php');
                }
                else{
                    echo "invalid username or password";
                }
    
                $conn->close();
            }
            // echo("connected successfully.")
        }

        }
    
    ?>

    <!-- <form action="" method="post">
    email:<input type="email" name="email" id="email" value="<?php echo $email;?>" ><br>
    <p></p>
    <br>
    password:<input type="password" name="pass" id="pass" value="<?php echo $pass;?>" ><br>
    <p></p>
    <br>
    <input type="submit" value="submit" name="submit">
    </form> -->

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
                <li><a href="blog.html">ABOUT</a></li>
                <li><a href="register1.php">REGISTER</a></li>
                <li class="active"><a href="#">LOGIN</a></li>
               
              </ul>
            </div>
          </div>
        </nav>

    <div class="container">
    <img src="images/avatar.png" alt="avatar" class="avatar">

                <fieldset>
        <Legend>LOGIN</Legend>
                <form class="form-horizontal" action="" method="POST" onsubmit=" return validate2('idx')">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="x" placeholder="Enter email" name="email" value="<?php echo $email;?>" onblur="validate('x','xe')">
                    </div>
                    <p><?php echo $emailErr;?></p>
                    <span><p id="xe" style="display: none"></p></span>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Password:</label>
                    <div class="col-sm-4">          
                      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass" value="<?php echo $pass;?>" onblur="validate('pwd','xxe')">
                    </div>
                    <p><?php echo $passErr;?></p>
                    <span><p id="xxe" style="display: none"></p></span>
                  </div>
                  
                  <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-4">
                      <div class="checkbox">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">        
                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-default">Submit</button>
                    </div>                  <span><p id="idx" style="display: none"></p></span>

                  </div>
                </form>
                </fieldset>

              </div>


</body>
</html>