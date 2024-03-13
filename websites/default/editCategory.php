<?php
// connecting with the database 
require 'data.php';
// using asset to identidy the name and passowrd 
if (isset($_POST['submit'])) {
    $idCat = $_POST['nam']; // Retriving the category id from the form
    $newCN = $_POST['pasu'];// Retriving the category name from the form

    // Check if category ID is provided or not
    if (!empty($idCat)) {
        // Prepare and execute the update query
        $editS = $connection->prepare("UPDATE aCategories SET name = :newCN WHERE cId = :idCat");
        $parE = [
            ':newCN' => $newCN, // binding the new category  name
            ':idCat' => $idCat // binding the new category id
        ];
// checking if the id is macthing or not
        if ($editS->execute($parE)) {
            echo "Successfully edited category with ID: " . htmlspecialchars($idCat); // when category upadte successful it shows the message 
        } else {
            echo "Invalid editing Category"; // it displays the error if fails the category
        }
    } else {
        echo "ID of the category cannot be empty."; // category id is manndatory to change the category 
    }
}

// Fetch and display the categories using prepared statement
$opss = $connection->prepare("SELECT * FROM aCategories"); // parepae statement is used to fetch all categories
$opss->execute();
$caa = $opss->fetchAll(PDO::FETCH_ASSOC); // fetching all the category in an associative array
?>

<!-- HTML form to edit a category -->
<form action="" method="POST"> 
    <!-- Enter category id -->
    <label for="nam">Enter category id: </label><br>
    <input type="text" name="nam" id="nam"><br>

    <label for="pasu">New Category to add:</label><br>
    <input type="text" name="pasu" id="pasu"><br>

    <input type="submit" value="submit" name="submit">

<br>
<a href="addCategory.php" style="color: white;">Go back?</a>
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Categories</title>
    <style>
        /* making form stylish by using following codess */
        form{
            margin: 4px;
            padding:5px;
            border:solid black 4px;
            align-items:center;
            text-align:center;
            width: 200px;
            height: 170px;
            display:flex;
            flex-direction: column;
            margin:auto;
            margin-top: 50px;
            border-radius: 12px;
            background-color:powderblue;

        }
        label input{
            margin:5px;
        }
        form:hover{
            background-color:skyblue;
        }

        
body{
    /* adding the bcakground image as well */

background-image: url('images/c3.jpg');
        background-repeat:no-repeat;
        background-position:center;
        background-size:cover;
}

</style>
</head>

