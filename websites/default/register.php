<?php
// using session to remember user data between different pages
session_start();

// Connection of Database adding
require 'data.php';

if (isset($_POST['submit'])) {
    // checking if the form is submitted or not 
    // Validating the input
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'yu';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'wu';
    $passw = isset($_POST['passw']) ? htmlspecialchars($_POST['passw']) : 'zu';
    if(strlen($passw)<7){
        // password is too short at least to write 7 chars
        echo  'You password must be at least 7 characters long';
     
    exit(); // helps to execute from the further execution
}

 // using hash in password to not to display the password in linked Database
    $hsp = password_hash($passw, PASSWORD_DEFAULT);

    // prepare method using by creating the table in Database.
    $instva = $connection->prepare('INSERT INTO userRegister (email, name, password) VALUES (:email, :name, :password)');
    $cre = [
        ':email' => $email, // Assign email vlaue to the email, name and password
        ':name' => $name,
        ':password' => $hsp
    ];

    $instva->execute($cre); // implementing

    // storing the data of user in session for later
    $_SESSION['rggUse'] = [
        'name' => $name,
        'email' => $email,
        'password' => $hsp,
    ];

    // it helps to redirect to login page
    header('Location: login.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title> 
    <style>
        /* body for whole page */
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('images/c5.jpg');
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;      
            opacity: 0.9 ;
        }
        /* form creating and adding diffenent styles */

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 7px;
            margin-bottom: 17px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }
        /* adding hover effect to the submit section */
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
    
</head>
<body>
    <!-- creating the login form to register the new users -->
    <form action="register.php" method="POST">
        <label for="name">Enter your Name:</label>
        <!-- need to type the name of the users -->
        <input type="text" name="name" required placeholder="Enter your name">
        
 <!-- need to type the email of the users -->
        <label for="email">Enter your Email:</label>
        <input type="text" name="email" required placeholder="john@gmail.com">
 <!-- need to type the password of the users -->
        <label for="passw">Enter your Password:</label>
        <input type="password" name="passw" required minlength="7" placeholder="Enter your password (atleast 7 characters)">
          <!-- need to click the submit of the users -->
        <input type="submit" value="Submit" name="submit">
        <a href="index.php">Go back</a>
    </br>
        <p>Already Registered? <a href="login.php">Login here> </a></p>
    </form>
    <!-- for footer section only  -->
    
			<footer >
				&copy; Carbuy 2024
			</footer>

</body>
</html>

