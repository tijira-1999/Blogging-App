<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="css/register.css">
  <link rel="stylesheet" type="text/css" href="css/navigation.css">


  <script type="text/javascript" src="javascript/register.js"></script>

    <title>Register page</title>

   
           
</head>
<body>

<?php
    $fnameErr=$lnameErr=$emailErr=$passErr=$rpassErr=$pass1Err=$userErr=$phoneErr=$rpass1Err=$imageErr="";
    $fname=$lname=$email=$pass=$Uname=$phone=$rpass="";
    $status=true;
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="lecturenotes";

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

        if(empty($_POST['Uname'])){
            $userErr="user name is empty";
            $status=false;

        }
        else{
            echo "user Name:" .$_POST['Uname']."<br>";
            $Uname=$_POST['Uname'];

        }

        if(empty($_POST['phone'])){
            $phoneErr="phone no. is empty";
            $status=false;

        }
        else{
            echo "phone number:" .$_POST['phone']."<br>";
            $phone=$_POST['phone'];

        }
        
        if(empty($_POST['email'])){
            $emailErr="email is empty";
            $status=false;

        }
        else{
            echo "email:" .$_POST['email']."<br>";
            $email=$_POST['email'];

        }
        if(empty($_POST['pwd'])){
            $passErr="password is empty";
            $status=false;

        }
        else{
            // echo "password:" .$_POST['pwd']."<br>";
            // $pass=$_POST['pwd'];
            // $pass=sha1($pass);

            if(empty($_POST['rpwd'])){
                $rpassErr="re-entered password is empty";
                $status=false;
    
            }
            else{
                // echo "password:" .$_POST['pass']."<br>";
                // $pass=$_POST['pwd'];
                // $pass=sha1($pass);

                if($_POST['pwd']==$_POST['rpwd']){
                    $pass=$_POST['pwd'];
                    $pass=sha1($pass);
                }
                else {
                  $status=false;
                  $rpass1Err="password mismatch";
                }
                
            }
        }

            
        // File related code
        $target_dir="uploads/";
        $target_file=$target_dir . basename($_FILES["image"]["name"]);
        $fileStatus = true;

        // get image extension
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png"){
          $imageErr= "only JPG and PNG images allowed";
          $fileStatus = false;
          $status = false;
        }

        if($fileStatus)
        {
          if(move_uploaded_file($_FILES["image"]["tmp_name"] , $target_file )){
            $status=true;
            //die("File uploaded");
          } 
          else 
          {
            $imageErr= "Issues in file upload";
            $status = false;
		      }
		    }
          
        

        
       
        if($status){
            // create new conection
            $conn = new mysqli($servername,$username,$password,$dbname);
    
            // check connection
            if($conn->connect_error){
                die("connection falied" . $conn->connect_error);
            }
            
            else{
            $sql= "INSERT into users (first_name,last_name,user_name,email,phone,password,images) values('$fname','$lname','$Uname','$email','$phone','$pass','$target_file') ";
    
                if($conn-> query($sql)) {
                        echo "new record created successfully.";
                        header('Location:login.php');
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
                <li class="active"><a href="#">REGISTER</a></li>
                <li><a href="login.php">LOGIN</a></li>
               
              </ul>
            </div>
          </div>
        </nav>
    
        <div class="container">
          <img src="images/avatar.png" alt="avatar" class="avatar">
                <fieldset>
        <Legend>REGISTER</Legend>
                <form class="form-horizontal" action="" method="post" onsubmit=" return validate2('idx')" enctype="multipart/form-data" >

                <div class="form-group">
                    <label class="control-label col-sm-2" for="fname">firstname:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="fname" placeholder="firstname" name="fname" onblur="validate('fname','fnam')">
                    </div>
                    <p id="fnam" style="display: none"></p>
                    <p><?php echo $fnameErr;?></p>
                </div>
                
                
                
                <div class="form-group">
                        <label class="control-label col-sm-2" for="lname">lastname:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="lname" placeholder="lastname" name="lname" onblur="validate('lname','lnam')">
                        </div>
                        <p id="lnam" style="display: none"></p>
                        <p><?php echo $lnameErr;?></p>
                    </div>
                    
                    
                    <div class="form-group">
                            <label class="control-label col-sm-2" for="Uname">Username:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="user" placeholder="Username" name="Uname" onblur="validate('user','use')">
                            </div>
                            <p id="use" style="display: none"></p>
                            <p><?php echo $userErr;?> </p>
                          </div>
                        
                        
                        
                        <div class="form-group">
                                <label class="control-label col-sm-2" for="phone">Phone:</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="phone" placeholder="phone number" name="phone" onblur="validate('phone','phon')" >
                                </div>
                                <p id="phon" style="display: none"></p>
                                <p><?php echo $phoneErr;?></p>
                            </div>
                            
                            
                  
                            <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" onblur="validate('email','emai')">
                    </div>
                    <p id="emai" style="display: none"></p>
                    <p><?php echo $emailErr;?></p>
                  </div>

                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Password:</label>
                    <div class="col-sm-4">          
                      <input type="password" class="form-control"id="pass" placeholder="Enter password" name="pwd" onkeyup="validate1('pass','pas')">
                    </div>
                    <p id="pas" style="display: none"></p>
                    <p><?php echo $passErr;?></p>
                  </div>
                  <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd" > Renter Password:</label>
                        <div class="col-sm-4">          
                          <input type="password" class="form-control" id="rpass" placeholder="Renter password" name="rpwd" onkeyup="validate1('rpass','rpas')">
                        </div>
                        <p id="rpas" style="display: none"></p>
                        <p><?php echo $rpassErr;?></p>
                      </div>
                      
                      <div  style="text-align: center;" id="x" style="display: none"></div>
                      <p><?php echo $rpass1Err;?></p>

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="image" > Upload Image:</label>
                        <div class="col-sm-4">          
                          <input type="file" class="form-control" id="image" placeholder="image" name="image">
                        </div>
                        <!-- <p id="rpas" style="display: none"></p> -->
                        <p><?php echo $imageErr;?></p>
                      </div>
                      
                      <div  style="text-align: center;" id="x" style="display: none"></div>
                      <p><?php echo $rpass1Err;?></p>

                      <div class="form-group">        
                          <div class="col-sm-offset-2 col-sm-4">
                            <div class="checkbox">
                              <label><input type="checkbox" id="agree" name="agree" required>I agree</label>
                            </div>
                          </div>
                        </div>
                  <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-4">
                      <div class="checkbox">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">        
                    <div class=" col-sm-4">
                      <button type="submit" class="btn btn-default" name="submit" >Submit</button>
                    </div>
                    <span><p id="idx" style="display: none"></p></span>
                  </div>
                </form>
                </fieldset>

              </div>
</body>
</html>
