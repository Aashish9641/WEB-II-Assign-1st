<?php
require 'data.php'; // connection with localhost

// Check if the user is logged in as an admin

if (isset($_POST['submit'])) { // checking if the form has been submitted or not 
    $email = htmlspecialchars($_POST['email'] ?? ''); // fetching the email input
    $password = htmlspecialchars($_POST['password'] ?? ''); // fetching the passwrod input
    $passV = htmlspecialchars($_POST['passV'] ?? ''); // fetching the password input

    // Validate password and its verification
    if ($password !== $passV) { // checking if the password is match or not
        echo 'Passwords do not match. Try again.'; // wrror messgae if the password is wrong
    } else {
        // Hash the password for better security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin into the database
        $insertAdmin = $connection->prepare('INSERT INTO adminLogin (email, password, passV) VALUES (:email, :password, :passV)');
        $insertAdmin->execute([':email' => $email, ':password' => $hashedPassword, ':passV' => $hashedPassword]);

        header('location: manageAdmin.php'); // redirect after success ful
        exit(); // no futher execution after this
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <style>
       /* adding  different sttyles for form*/


       body {
            font-family: sans-serif;
            /* background-color: skyblue; */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('images/c10.jpg');
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            width:700px;
            
            
        }
/* for form adding styles */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin:10px;
            padding-right:50px;
            opacity: 0.8;
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

        input[type="addadin"] {
            background-color: white; 
            color: black;
            cursor: pointer;
            border:solid black;
            border-radius:5px;
            width: auto;
        }   
        /* adding hover effect for the submit buttion */

        input[type="submit"]:hover {
            background-color: aqua; 
            color:black;
            border-radius:5px;
        } */
    </style>
</head>
<body>
    <!-- Add your HTML form for adding admin here -->
    <form action="addAdmin.php" method="POST">
        <!-- Add form fields for email, password, and password verification -->
        <label for="email">Enter Admin Email:</label>
        <input type="text" name="email" required placeholder="example@gmail.com">
        </br>
        <label for="password">Admin Password:</label>
        <input type="password" name="password" required placeholder="Enter admin password">
        </br>
        <label for="passV">Verify Admin Password:</label>
        <input type="password" name="passV" required placeholder="Verify admin password">
        </br>
        <!-- Add submit button -->
        <input type="submit" name="submit" value="Add Admin">
        </br></br>
        <!-- Adding  a link to go back to the main admin page -->
        <a href="index.php."> < Go back</a> 
    </form>
</body>
</html>
