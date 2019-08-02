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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>YOUR PROFILE</title>

    <link rel="stylesheet" type="text/css" href="css/profilex.css">
    <script type="text/javascript" src="javascript/profilexeditprofile.js"></script>


</head>
<body>
    
<?php
    $fnameErr=$lnameErr=$emailErr=$passErr=$rpassErr=$pass1Err=$userErr=$phoneErr=$rpass1Err=$imageErr="";
    $fname=$lname=$email=$pass=$Uname=$phone=$rpass="";
    $titleErr=$desErr="";
    $title=$des="";
    $status=true;
    $status1=true;
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




            // edit profile part


            if(empty($_POST['fname'])){
                $fnameErr="first name is empty";
                $status1=false;
            }
            else{
            $fname=$_POST['fname'];
    
            }
            
            if(empty($_POST['lname'])){
                $lnameErr="last name is empty";
                $status1=false;
    
            }
            else{
                $lname=$_POST['lname'];
    
            }
    
            if(empty($_POST['Uname'])){
                $userErr="user name is empty";
                $status1=false;
    
            }
            else{
                $Uname=$_POST['Uname'];
    
            }
    
            if(empty($_POST['phone'])){
                $phoneErr="phone no. is empty";
                $status1=false;
    
            }
            else{
                $phone=$_POST['phone'];
    
            }
            
            if(empty($_POST['email'])){
                $emailErr="email is empty";
                $status1=false;
    
            }
            else{
                $email=$_POST['email'];
    
            }
            if(empty($_POST['pwd'])){
                $passErr="password is empty";
                $status1=false;
    
            }
            else{
                // echo "password:" .$_POST['pwd']."<br>";
                // $pass=$_POST['pwd'];
                // $pass=sha1($pass);
    
                if(empty($_POST['rpwd'])){
                    $rpassErr="re-entered password is empty";
                    $status1=false;
        
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
                      $status1=false;
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
              $status1 = false;
            }
    
            if($fileStatus)
            {
              if(move_uploaded_file($_FILES["image"]["tmp_name"] , $target_file )){
                $status1=true;
                //die("File uploaded");
              } 
              else 
              {
                $imageErr= "Issues in file upload";
                $status1 = false;
                  }
                }


            if($status1){
                // create new conection
                $conn1 = new mysqli($servername,$username,$password,$dbname);
            
                // check connection
                if($conn1->connect_error)
                {
                    die("connection falied" . $conn1->connect_error);
                }
                    
                else
                {
                    // $sql1= "INSERT into users (first_name,last_name,user_name,email,phone,password,images) values('$fname','$lname','$Uname','$email','$phone','$pass','$target_file') ";
                    $id1=$_SESSION['userDetails']['id'];
                    $sql1= "UPDATE users 
                            
                            SET first_name = '$fname',
                            last_name = '$lname',
                            user_name = '$Uname',
                            email = '$email',
                            phone = '$phone',
                            password = '$pass',
                            images = '$target_file'
                            
                            WHERE id = $id1 ;";


                    if($conn1-> query($sql1))
                    {
                                // echo "profile edited successfully.";
                                header('Location:login.php');
                    }
                    else
                    {
                        echo "error" .$sql1. "<br>" . $conn1->error;
                    }
        
                    $conn1->close();
                }
                // echo("connected successfully.")
            }                
              
            
    
           
    
            // post table part
           
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
                    // echo "new record created successfully.";
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
    // else{
    //     header('location:login.php');
    // }
    
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
                <li><a href="#myModal1" data-toggle="modal">EDIT PROFILE</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
               
              </ul>
            </div>
          </div>
        </nav>

        <!-- this is to edit profile -->

        <div class="container">
              <!-- Modal -->
                <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">EDIT PROFILE</h4>
                        </div>
                        <form class="form-horizontal" action="" method="post" onsubmit=" return validate2('idx')" enctype="multipart/form-data">
                        <div class="modal-body">

                            
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="fname">firstname:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="fname" placeholder="firstname" name="fname" value="<?php echo $_SESSION['userDetails']['first_name'];?>" onblur="validate('fname','fnam')">
                                </div>
                                <p><?php echo $fnameErr;?></p>
                                <p id="fnam" style="display: none"></p>
                                <br>
                            </div>
                            <!-- <div class="form-group">
                                <label for="des">Description:</label>
                                <textarea  class="form-control" placeholder="Enter Description" name="des" id="des" rows="5" onblur="x('des','de')"></textarea>
                                <p id="fnam" style="display: none"></p>
                                <p> -->
                                    
                                <!-- </p>
                                <br>
                            </div> -->







                            <div class="form-group">
                                <label class="control-label col-sm-4" for="lname">lastname:</label> 
                                <div class="col-sm-4">                       
                                    <input type="text" class="form-control" id="lname" placeholder="lastname" name="lname" value="<?php echo $_SESSION['userDetails']['last_name'];?>" onblur="validate('lname','lnam')">                        
                                </div>
                                <p id="lnam" style="display: none"></p>
                                <p><?php echo $lnameErr;?></p>
                                <br>
                            </div>
                    
                    
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="Uname">Username:</label>
                                <div class="col-sm-4">                         
                                    <input type="text" class="form-control" id="user" placeholder="Username" name="Uname" value="<?php echo $_SESSION['userDetails']['user_name'];?>" onblur="validate('user','use')">
                                </div>
                                <p id="use" style="display: none"></p>
                                <p><?php echo $userErr;?> </p>
                                <br>
                            </div>
                        
                        
                        
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="phone">Phone:</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="phone" placeholder="phone number" name="phone" value="<?php echo $_SESSION['userDetails']['phone'];?>" onblur="validate('phone','phon')" >                               
                                </div>
                                <p id="phon" style="display: none"></p>
                                <p><?php echo $phoneErr;?></p>
                                <br>
                            </div>
                            
                            
                  
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="email">Email:</label> 
                                <div class="col-sm-4">                   
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $_SESSION['userDetails']['email'];?>" onblur="validate('email','emai')">                   
                                </div>
                                <p id="emai" style="display: none"></p>
                                <p><?php echo $emailErr;?></p>
                                <br>
                            </div>

                  
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="pwd">New Password:</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control"id="pass" placeholder="Enter password" name="pwd" onkeyup="validate1('pass','pas')">
                                </div>
                                <p id="pas" style="display: none"></p>
                                <p><?php echo $passErr;?></p>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" for="pwd" > Renter New Password:</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" id="rpass" placeholder="Renter password" name="rpwd" onkeyup="validate1('rpass','rpas')">
                                </div>
                                <p id="rpas" style="display: none"></p>
                                <p><?php echo $rpassErr;?></p>
                                <br>
                            </div>
                      
                            <div  style="text-align: center;" id="x" style="display: none"></div>
                            <p><?php echo $rpass1Err;?></p>

                            <div class="form-group">
                                <label class="control-label col-sm-4 proimage" for="image" > Change Image:</label>                               
                                <div class="col-sm-4 proimage">
                                    <input type="file" class="form-control" id="image" placeholder="image" name="image" value="<?php echo $_SESSION['userDetails']['images'];?>" required>                                
                                </div>

                                <div class="col-sm-3">
                                    <img src=" <?php if($_SESSION['userDetails']['images']) echo $_SESSION['userDetails']['images']; else?>" height=80px width=80px alt="image" style="border-radius:25px">
                                </div> 

                                <p><?php echo $imageErr;?></p>
                                <br>
                            </div>   
                                 
                        
                        </div>
                        
                        <div class="modal-footer a">                        
                            <button type="submit" class="btn btn-success">Done</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>

                        <span><p id="idx" style="display: none"></p></span>
                        
                        </form>
                    </div>
                    
                    </div>
                </div>
        </div>

        <!-- this to create a new post -->

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
                        <form action="" method="post" onsubmit="return xxx('idx1')">
                        <div class="modal-body">

                            
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" placeholder="Enter Title" name="title" id="title" onkeyup="x('title','tit','des','de')">
                                <p><?php echo $titleErr;?></p>
                                <p id="tit" style="display: none"></p>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="des">Description:</label>
                                <textarea  class="form-control" placeholder="Enter Description" name="des" id="des" rows="5" onkeyup="x('title','tit','des','de')"></textarea>
                                <p><?php echo $desErr;?></p>
                                <p id="de" style="display: none"></p>
                                <br>
                            </div>
                                 
                        
                        </div>
                        
                        <div class="modal-footer a">                        
                            <button id="sub" type="submit" class="btn btn-success" disabled>Create</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>

                        <span><p id="idx1" style="display: none"></p></span>

                        </form>
                    </div>
                    
                    </div>
                </div>
        </div>


        <!-- this is to update post -->

        <div class="container">
              <!-- Modal -->
                <div class="modal fade" id="myModalpost" role="dialog">
                    <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">UPDATE POST</h4>
                        </div>
                        <form action="" method="post" onsubmit="return xxx('idx2')">
                        <div class="modal-body">

                            
                            <div class="form-group">
                                <label for="title1">Title:</label>
                                <input type="text" class="form-control" placeholder="Enter Title" name="title1" id="title1" onkeyup="x1('title1','tit1','des1','de1">
                                <p><?php echo $titleErr;?></p>
                                <p id="tit1" style="display: none"></p>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="des1">Description:</label>
                                <textarea  class="form-control" placeholder="Enter Description" name="des1" id="des1" rows="5" onkeyup="x1('title1','tit1','des1','de1')"></textarea>
                                <p><?php echo $desErr;?></p>
                                <p id="de1" style="display: none"></p>
                                <br>
                            </div>
                                 
                        
                        </div>
                        
                        <div class="modal-footer a">                        
                            <button id="sub1" type="submit" class="btn btn-success" disabled>Update</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>

                        <span><p id="idx2" style="display: none"></p></span>

                        </form>
                    </div>
                    
                    </div>
                </div>
        </div>


        <!-- profile display on left -->

        <div class="left">
        <h1>Welcome</h1>      

                <?php
                echo "<h3>".$_SESSION['userDetails']['first_name']." ".$_SESSION['userDetails']['last_name']."</h3>"
                ?>
                <br>
                
            <div class="picimg">
            <img src="<?php 
                        if($_SESSION['userDetails']['images'])
                            echo $_SESSION['userDetails']['images'];
                            else
                        
                      ?>" 
                      height=200px width=200px alt="image">
            </div>
            <br>
            
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
                
                
            </div>
            <hr>
            <h4>Contact Me</h4>
            <div class="oo">
                <a href="https://github.com/tijira-1999" target="_blank"><i class="fa fa-github"style="font-size:30px"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="https://www.linkedin.com/in/arijit-sahoo-62b099183" target="_blank"><i class="fa fa-linkedin-square" style="font-size:30px"></i></a>
            </div>


        </div>



        <!-- blog display on right -->

        <div class="image"></div>
        <div class="right">
            
            <h1 style="text-align:left;">My blogs...</h1>
            <?php
                if($status){
                    // create new conection
                    $conn = new mysqli($servername,$username,$password,$dbname);
                    $id=$_SESSION['userDetails']['id'];
                    $sql="SELECT title,description,post.created_date_time,post.last_update_date_time from post
                    inner join users on post.user_id=users.id where user_id=$id";
                    $postresult=$conn->query($sql);
                    echo "<div class='bb'>";
                    while($row=$postresult->fetch_assoc())
                    {
                    echo "<div class='b'>";
                    echo "<h2>".$row["title"]."</h2> <a href='#myModalpost' style='color:#00bfff;background:none' data-toggle='modal'><span class='glyphicon glyphicon-pencil'></span></a>      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       <a href='#myModalpost' style='color:#f4511e' data-toggle='modal'> <span class='glyphicon glyphicon-trash'></span> </a> <hr>";
                    echo "<pre>Created On:  " .$row["created_date_time"]."               Updated On:  " .$row["last_update_date_time"]."</pre>" ;
                    echo "<br><br>";
                    echo "<p>".$row["description"]."</p></div>";
                    
                    }
                    echo "</div>";

                $conn->close();
                }
            ?>
        </div>
        

</body>
</html>