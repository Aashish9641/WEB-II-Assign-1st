<?php
require 'data.php'; // connection with teh database and including the files in connected details

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $title = $_POST["title"];
    $description = isset($_POST["description"]) ? $_POST["description"] : ''; // getting the description from form and setting empty string
    $categoryId = isset($_POST["categoryId"]) ? $_POST["categoryId"] : ''; // getting the id of the category from form and setting empty string
    $categoryName = isset($_POST["category"]) ? $_POST["category"] : ''; // getting the name from form and setting empty string
    $endDate = isset($_POST["endDate"]) ? $_POST["endDate"] : ''; // getting the end Date from form and setting empty string
    $bid = isset($_POST["amount"]) ? $_POST["amount"] : ''; // getting the bid amount from form and setting empty string


    // inserting into the auction table creating the database
    $sql = "INSERT INTO auction (title, description, categoryId, categoryName, bid,endDate)
    VALUES (:title, :description, :categoryId,:categoryName,:bid, :endDate)"; // using sql query to insert in the table name auction

    $neps = $connection->prepare($sql); // making the sql structure

    // Bind parameters
    $neps->bindParam(':title', $title);
    $neps->bindParam(':description', $description);
    $neps->bindParam(':categoryId', $categoryId);
    $neps->bindParam(':categoryName', $categoryName);
    $neps->bindParam(':endDate', $endDate);
    $neps->bindParam(':bid', $bid);



    // Declaring the structure and handling the different exception
    try {
        $neps->execute(); // implementing the structure
        $idN = $connection->lastInsertId(); // get the id of the last row
        // Redirect to the auction details page or another suitable page
        header("Location: index.php?id=$idN&category=$categoryName");
        exit(); // no more further execution
    } catch (PDOException $p) {
        echo "Error debugging structure: " . $p->getMessage(); // display the message if the exception arises
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Auction</title>
</head>
<style>
    /* adding the css for for creating in  auction */
        form {
            background-color: aqua;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 11px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            align-items:center;
            margin: auto;

        }


</style>

<body>

    <!-- creating the form in heml by using post method -->
    <form action="addAuction.php" method="POST">
        <!-- Adding the Title,Description,CategoryId and endDate -->
        <label for="title">Title:</label>
        <input type="text" name="title" required placeholder ="Select Title:"   >
</br></br>

<!-- type for Description -->
        <label for="description">Description:</label>
        <textarea name="description"  require placeholder="Write the description of category ..."rows="5" cols="55"></textarea>
</br></br>


<!-- type for category id -->
        <label for="category">Category Id:</label>
        <input type="text" name="categoryId" require placeholder="Enter category id:">
        </br></br>

        
        <label for="category">Category name:</label>
<select name="category" required>
    <option value=""require>Select the category:</option>
    <option value="Esatte">Esatte</option>
    <option value="Electrict">Electrict</option>
    <option value="Couple">Couple</option>
    <option value="Saloon">Saloon</option>
    <option value="4X4">4X4</option>
    <option value ="sports">Sports</option>
    <option value ="Hybrid">Hybrid</option>
    
</select>
</br></br>



        

<label for="endDate">End Date:</label>

        <input type="date" name="endDate" require placeholder="Select the end date:">

</br></br>
<label for="amount">Enter bid amount:</label></br>
<input type="text" name="amount" id="amount">
</br></br>

<!-- submit option -->
        <input type="submit" value="Add Auction">
    </br></br>


    </br></br>


        <a href ="index.php">  < Go back </a> <!-- add to link to go index file -->
    </form>
    <!-- adding the footer as well  -->
    <footer>
				&copy; Carbuy 2024
			</footer>
</body>
</html>
