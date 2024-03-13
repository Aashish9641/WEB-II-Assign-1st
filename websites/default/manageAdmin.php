<?php
require 'data.php'; // including the file contaning in connected database

// Fetch admin users from the database
try {
    $upb = $connection->prepare('SELECT * FROM adminLogin'); // using prepare strcuture to select all adimin users
    $upb->execute();
    $ipo = $upb->fetchAll(PDO::FETCH_ASSOC); // Fetching all admin users in array
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); // if there is any bug it will show the error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins</title>
</head>
<body>
    <h2>Admin Users</h2>
    <!-- using table to display the added admin -->
    <table border="2">
        <tr>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($ipo as $psl): ?> <!-- loop through each admin users separatly -->
    <tr>
        <td><?= $psl['email']; ?></td> <!-- it wil display the email of the users -->
        <td>
            <?php if (isset($psl['id'])): ?> <!-- checking if the id is set or not in the code -->
                <a href="deleteAdmin.php    ">Delete</a> <!-- added the link of delet.php -->
            <?php else: ?>
                <!-- Handle the case where 'id' is not set -->
                Delete
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>


    </table>
    <br>
    <a href="addAdmin.php">Add New Admin</a> <!-- link to add the new admin -->
</body>
</html>
