<?php

session_start();// resume or start of the session
require 'data.php'; //joining with teh database and file containing connection details

if (isset($_POST['submit'])) { // verifying the form is submitted or not
    $categoryId = $_POST['categoryId']; // get the id from form
    $categoryName = $_POST['categoryName']; // get the name of category from form
    $title = $_POST['title']; // get the title from the form
    $description = $_POST['description']; // get the description from form
    $endDate = $_POST['endDate']; // get endDate from the from

    // Check if the provided categoryId is not empty
    if (!empty($categoryId)) {
        // Retrieve the auction details from the database
        $sql = "SELECT * FROM auction WHERE categoryId = :categoryId";
        $prime = $connection->prepare($sql);
        $prime->bindParam(':categoryId', $categoryId);
        $prime->execute();
        $act = $prime->fetch(PDO::FETCH_ASSOC); // Fetching in the associtavie array

        // Check if an auction with the provided categoryId exists
        if (!empty($act)) {
            // Update the auction in the database
            $sql = "UPDATE auction SET title = :title, description = :description, categoryName = :categoryName, endDate = :endDate WHERE categoryId = :categoryId";
            $prime = $connection->prepare($sql);
            $prime->bindParam(':categoryId', $categoryId);
            $prime->bindParam(':categoryName', $categoryName);
            $prime->bindParam(':title', $title);
            $prime->bindParam(':description', $description);
            $prime->bindParam(':endDate', $endDate);

            try {
                $prime->execute();
                // Redirect to the index page with a success message
                header("Location: index.php?message=update-successful");
                exit();
            } catch (PDOException $p) {
                $errorMessage = "Error updating auction: " . $p->getMessage(); // dispaly the message if the exception occurs
            }
        } else {
            // Display an error message when categoryId does not match
            $errorMessage = "Category ID does not match an existing auction.";
        }
    } else {
        $errorMessage = "Category ID cannot be empty."; // this is very mandatory part
    }
}

// Display the form to enter the categoryId if not provided
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Auction</title>
    <style>
        /* Adding the CSS for editing an auction form */
        form {
            background-color: lightblue;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 11px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            align-items: center;
            margin: auto;
        }
    </style>
</head>
<body>
    <!-- Creating the form in HTML using POST method to get categoryId -->
    <form action="editAuction.php" method="POST">
        <!-- Adding the categoryId input field -->
        <label for="categoryId">Enter Category Id:</label>
        <input type="text" name="categoryId" required placeholder="Enter category id">
        <br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" required placeholder="Select Title:"   ><br><br>

        <label for="description">Description:</label>
        <textarea name="description" require placeholder="Write the description of category ..." rows="5" cols="55"></textarea><br><br>
<!-- using drop down menu for the setting up the different values -->
        <label for="categoryName">Category name:</label>
        <select name="categoryName" required>
            <option value="">Select the category:</option>
            <option value="Esatte">Esatte</option>
            <option value="Electrict">Electrict</option>
            <option value="Couple">Couple</option>
            <option value="Saloon">Saloon</option>
            <option value="4X4">4X4</option>
            <option value="sports">Sports</option>
            <option value="Hybrid">Hybrid</option>
        </select><br><br>

        <label for="endDate">End Date:</label>
        <input type="date" name="endDate" require placeholder="Select the end date:"><br><br>

        <input type="submit" name="submit" value="Edit Auction"><br><br>

    </br>
    <a href ="bid.php" style=" color:blue;"> Current Bid $ : </a>
 <!-- Display erro message if any occurs -->
        <?php if (isset($errorMessage)) : ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
