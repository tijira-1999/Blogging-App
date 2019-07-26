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
   echo" <h1>Hello World.</h1> ";
   $firstname= "Arijit";
   $lastname="Sahoo";
   echo'Firstname:'.$firstname.'<br>';
   echo'lastname: $lastname <br>';

   $x=3;
   if ($x<=100) {
       echo"you can gift a rose";
   } elseif ($x>100 && $x<=500) {
    echo"you can gift a perfume";
} elseif ($x>500 && $x<=2000) {
    echo"you can gift a date";
} 
elseif ($x>2000 && $x<5000) {
    echo"you can gift a ring";
} 
else{
    echo"invalid";


}
    
var_dump($firstname);
   switch($x)
   {
       case 1:echo "one";
            break;
       case 2:echo"tWo";
            break;
       case 3:echo "Three";
            break;
       case 4:echo"Four";
            break;

   }

   ?>
</body>
</html>