<?php
require 'data.php';



if (isset($_POST['submit'])) {
    // validate the bid amount 
    $bida = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);

    if ($bida !== false) {
        try {
            // Perform the SQL INSERT operation
            $mon = $connection->prepare('INSERT INTO bid (bidAmount) VALUES (:mons)');
            $mon->bindParam(':mons', $bida, PDO::PARAM_STR);
            $mon->execute();

            header('location:index.php');
        } catch (PDOException $g) {
            echo 'Invalid storing the bid amount: ' . $e->getMessage();
        }
    } else {
        echo 'eroor bid amount.';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">


    <Style>
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

        form {
            background-color: aqua;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin:10px;
            padding-right:50px;
            opacity: 0.8;
        }
        form:hover{
            background-color: skyblue;
        }

        </Style>
</head>


<body>
</br></br>
<form action="bid.php" method="POST">
 <label for="amount">Enter bid amount:</label></br>
<input type="text    " name="amount" id="amount">
</br/></br>


<input type="submit" value="submit" name="submit">

</form>


    
</body>
</html>