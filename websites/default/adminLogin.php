<?php
require 'data.php';
// specifying this email and password as admin 
$allEm = 'nami123@gmail.com';
$allPs = 'nami@123';

if (isset($_POST['submit'])) {
    // validation input
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    $passV = htmlspecialchars($_POST['passV'] ?? '');
// this is used to display hash the password in database
    $rpr = password_hash($password, PASSWORD_DEFAULT); // using hash to show the random number in database

    // check if the given email match or not and allows if right
    if ($email === $allEm && $password === $allPs && $passV === $allPs) {
        // giving the message 
        echo 'Added Successfully';

        // inserting into database connection and Eexcuting
        $ins = $connection->prepare('INSERT INTO adminLogin (email, password, passV) VALUES (:cms, :passo, :passvv)');
        $ipss = [
            ':cms' => $email,
            ':passo' => $rpr,
            ':passvv' => $rpr
        ];
        $ins->execute($ipss);

        //it helps to  Redirect in admin iterface
        header('location: addCategory.php');
        exit(); // no futher code  is executed after this
    } else {
        // show the invalid message if it is wrong 
        echo 'Invalid. Try again.';
    }
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
            font-family: sans-serif;
            /* background-color: skyblue; */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('images/c9.jpg');
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            width:600px;
            
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin:10px;
            padding-right:50px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: white; 
            color: black;
            cursor: pointer;
            border:solid black;
            border-radius:5px;
            width: auto;
        }   

        input[type="submit"]:hover {
            background-color: blue; 
            color:white;
        }
        </style>
</head>
<body>
    <!-- for admin login by using POST method -->
<form action="adminLogin.php" method="POST">
        <label for="mail">Enter your Email:</label>
        <input type="text" name="email" required placeholder="example@gmail.com">
    </br>
        <label for="password">Password:</label>
        <input type="password" name="password" required placeholder="Enter your password">
    </br>
        <label for="password">Verify your Password:</label>
         <input type="password" name="passV" required placeholder="Verify your password">

         <!-- forget the password -->
        <a href="#">Forgot password</a>  
    </br>
    </br>
    
        <input type="submit" name="submit" value="Submit">
    </br>
    </br></br>

    <a href ="index.php">  < Go back </a>
</body>
</html>