<?php
// using session to remember user data between different pages
session_start();

// Connection to the database
require 'data.php';

$img = '';

if (isset($_POST['submit'])) {// checking if the form is submitted or not 
    if ($_POST['fmtp'] == 'login') { // checking the login
        $email = isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : 'wu';
        $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : 'zu';

        // Check if the user is already registered in the session
        if (isset($_SESSION['rggUse'])) {
            $rggUse = $_SESSION['rggUse'];


            $_SESSION['userLog'] = [
    'name' => $rggUse['name'], // Replaceing the real user name
];
            // verifying the login values match or not
            if ($email === $rggUse['email'] && password_verify($password, $rggUse['password'])) {

                $_SESSION['userLog'] = [
                    'name' => $rggUse['name'], // matchin the value with resiter.php
                ];
                header('Location: index.php'); // after matching it redirects to index.php 
                exit();
            } else {
                $img = 'Invalid login. Try again.';  // shows the error messagae if not match
            }
        } else {
            $img = 'User not registered. Please register first.'; // giving the error message if the user is not registered
        }
    } elseif ($_POST['fmtp'] == 'register') { 
        $email = isset($_POST['email']) ? $_POST['email'] : 'yu'; //assigning the email to email
        $password = isset($_POST['password']) ?$_POST['password'] : 'wu'; //assigning the email to email

        // Check if the user is already registered in the database
        $stmt = $connection->prepare('SELECT * FROM userLogin WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $es = $stmt->fetch(PDO::FETCH_ASSOC); // Fetching the datas

        if ($es) {
            $img = 'User is  already registered. Please  do log in.'; // if the user is login then user can directly login
        } else {
            // If not registered, proceed to insert into the database
            $inst = $connection->prepare('INSERT INTO userLogin (email, password) VALUES (:email, :password)');
            $cree = [
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
            ];

            $inst->execute($cree); // declaring the structure

            // storing the data of the user for later use
            $_SESSION['rggUse'] = [
                'email' => $email,
                'password' => $cree[':password'],
            
            ];

            $img = 'Registration successful'; // show the verefied message if successful
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Registration</title>
    <style>
        body {
            font-family: sans-serif;
            background-image: url('images/c8.jpg');
            background-repeat:no-repeat;
            background-position:center;
            opacity: 0.9 ;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size:cover;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
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
            background-color: #ff69b9; 
            color: #fff;
            cursor: pointer;
        }   

        input[type="submit"]:hover {
            background-color: #ff3385; 
        }

        .img {
            margin-top: 10px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- creatig the form to login the uses -->
    <form action="login.php" method="POST">
        <label for="Admin">Login:</label>
        <br>
        <label for="Email">Enter your Email:</label>
        <input type="text" name="Email" required placeholder="mary123@gmail.com">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required placeholder="Enter your password">
        <a href="#">Forgot password</a> 
        <input type="hidden" name="fmtp" value="login">
        <br><br>
        <input type="submit" name="submit" value="Submit"> 
        <a href ="index.php">  < Go back </a>
    </br></br>
        <!-- user can register to login page -->
        <a href="register.php"> < Register here</a>
        <div class="img"><?php echo $img; ?></div>
    </form>
</body>
</html>
