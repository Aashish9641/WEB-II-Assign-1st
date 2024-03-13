<?php
//giving the location for login or register for users
    if (isset($_POST['submit'])) {
        if (isset($_POST['type_user'])) {
            $typeUser = $_POST['type_user'];
            // Display the login and Register for users to login
            if ($typeUser === 'admin') {
              header ('Location: login.php');
                exit(); // redirects to login page 
            }
            // it redirects to the register page for regristration
            if ($typeUser === 'user') {
                header('Location: register.php');  // redirect to register page 
                exit(); // exit no code execute after this
        }
    }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="carbuy.css" /> 

    <title>Login page</title>
    
    
    <style>
        /* adding the different  style for login and logout */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
            background-image: url('images/c1.jpg');
            background-size:cover;
            background-repeat:no-repeat;
            opacity: 0.9;
           

            
        }
        /* adding differetn styles */

        .cont {
            width: 30%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            spacing:5px;
            
        }
        /* adding for from */

        form {
            text-align: center;
        }
/* adding differetn styles */
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
/* adding differetn styles */
        label {
            font-size: 18px;
            margin: 10px;
            display: column;
            margin-top:4px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }
 /* created fopr submit option */
        input[type="submit"] {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 3px;
            margin-top:5px;
        }

        /* adding differetn styles */

        input[type="submit"]:hover {
            background-color: blue;
        }
        
        .adminCont {
            width: 40%;
            background-color: white;
            padding: 19px;
            border-radius: 11px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            spacing:5px;
            margin-left:100px;
            text-align:center;
           
        }

        h2 {
            font-size: 23px;
         color: #333;
          }

       p {
         font-size: 17px;
         color: #555;
          margin-bottom: 11px;
         }

         a {
         text-decoration: none;
         color: black ;
         font-weight: bold;
    
         }
         /* adding differetn styles like hover */

         a:hover {
          text-decoration: underline;
          color:blue;
    
         }

    </style>
</head>

<body>
    <div class="cont">
        <form action="new.php" method="POST">
            <!-- asking if the user is new or already registed -->
            <h1>Only for users:</h1>
            <h1>Are you new ?</h1>
            <!-- creating the form for register or login -->
            <label>
                <!-- using radio option for choosing  the info -->
                <input type="radio" name="type_user" value="user" required> Register
            </label>
            <label>
                <input type="radio" name="type_user" value="admin" required> Sign in
            </label>
            <br>
            <!-- submitiing the providede information -->
            <input type="submit" value="Submit" name="submit" required>
        </form>
    </div>
</body>
</html>
<!-- creating for admin users only  -->
        <div class="adminCont">
            <h2>Only for Admin:</h2> <!-- created for admin login -->
            <p>Only admins are allowed to login this:</p>
            <!-- Created for admin login only -->
            <a button="login" style=" text-decoration: underline;"href="adminLogin.php">Go for Login > </a> 
        </div>
    </div>
 </br>
 </br>


<!-- giving the link of index.php fot go back to the users and admin -->
    <a href="index.php" style="text-decoration: underline;">Go back</a>
 

 

</body>

</html>

