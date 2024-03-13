<?php
require 'data.php'; //connecting with the database file
// checking if the form is submoitted or not via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nameCatt = $_POST['nameCatt']; // Getting the name of category from form
    $is = isset($_POST['is']) ? $_POST['is'] : null; // setting it to the null

    //checking if is(id) is empty of not in following 
    if (!empty($is)) {
        //executing the sql query  and insert into the table name aCategory
        $admis = $connection->prepare("INSERT INTO aCategories (name, cId) VALUES (:ns, :i)");
        $upss = [
            ':ns' => $nameCatt, // binding the category name 
            ':i' => $is  //// binding the category id 
        ];
          // only user is allowed to add the category after login in admin
        if ($admis->execute($upss)) {
            echo "Successfully added: " . htmlspecialchars($nameCatt);
        } else {
            echo "Invalid adding Category"; // if the id of category is not present then the category will not be present 
        }
    } else {
        echo "Category ID cannot be empty."; // Displaying the error message 
    }
}

// Fetching  and displaying  the categories using prepared statement
$dispC = $connection->prepare("SELECT * FROM aCategories");
$dispC->execute();
$caa = $dispC->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- HTML form to add a category -->
<form method="post" action="addCategory.php">
<label for="is">Category ID:</label><br>
    <input type="text" name="is" required>
</br>
    <label for="nameCatt">Category Name:</label><br>
    <input type="text" name="nameCatt" required>
</br>
<div class=bt>
    <!-- following structure are used to creating the edit, add,delete and adding the admin -->
    <button type="submit" style="background-color: blue; color: white; border-radius: 8px; padding:8px 12px;text-decoration: underline;">Add Category</button>
    <a href="editCategory.php" style="background-color: aqua;color:black; border-radius: 8px; padding: 8px 12px; text-decoration: underline;transition:background-color 0.4s;">Edit Categories</a>
    <a href="deletCategory.php" style="background-color: black;color:white; border-radius: 8px; padding: 8px 12px; text-decoration: underline;transition:background-color 0.43s;">Delete Categories</a>
    <a href="addAdmin.php" style="background-color: gray;color:white; border-radius: 8px; padding: 8px 12px; text-decoration: underline;transition:background-color 0.3s;">Add Admin</a>
    <div>
</form>

<!-- Displaying the Categories and allow users to view them -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Types</title>
    <style>
/* adding different styles for different parts */
        
    a:hover{
        background-color: violet;
        
    }
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
            background-color:violet;
}
    .form:hover{
    background-color:purple;
    color:white;
}


.bt{
    margin-top:40px;
    display:column;
    width:500px;
    padding:15px;
    margin-right:50px
    margin:auto;
    gap: 30px;

    
}


body{

    background-color:skyblue;
}
    </style>
</head>
<body>
    <!-- Displaying the Categories -->
    <div class="cas">
    <h2>List of the Categories </h2>
    <!-- checking if the categories are available or not -->
    <?php if (!empty($caa)) : ?>
      <table>
        <tr>
            <th>ID no.</th>
            <th>Category name</th>
    </tr>
    <!-- looping thorugh each category to make visible the id and name -->
    <?php foreach ($caa as $cacse) : ?>
        <!-- following code used to display the  category id and name -->
        <tr>
        <td><?php echo htmlspecialchars($cacse['cId']); ?></td>
        <td><?php echo htmlspecialchars($cacse['name']);?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
        <p>No Categories here for now !!!</p> <!-- displaying the message  -->
    <?php endif; ?>


    <!-- it helps to go back to the index page -->
    <a href="index.html">Go back?</a>


    
</body>
</html>
