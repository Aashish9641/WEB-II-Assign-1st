<?php
ob_start(); // beginning of the outpur buffering 

$servername ='mysql';  // define the servername
$username ='student'; // define the username
$password ='student';  // define the password
$databasename ='ijdb';  // define the databasename

 
    // making PDO connection to the Databse
$connection = new PDO('mysql:dbname='.$databasename . ';host=' .$servername,$username,$password);
if($connection){
     echo ''; // if the connection is success ful the it will show the null string.
}
?>
