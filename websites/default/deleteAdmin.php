<?php
require 'data.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $adminId = $_GET['id'];

    try {
        // Prepare and execute a DELETE query
        $deleteQuery = $connection->prepare('DELETE FROM adminLogin WHERE id = :id');
        $deleteQuery->bindParam(':id', $adminId, PDO::PARAM_INT);
        $deleteQuery->execute();

        // Redirect after successful deletion
        header('location: manageAdmin.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle the case where 'id' is not provided or not numeric
    echo "Invalid request.";
}
?>
