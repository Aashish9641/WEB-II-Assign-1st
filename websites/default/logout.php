<?php
// Beginnig the session
session_start();

// session variables are unsetting 
$_SESSION = array();

// Session destroy
session_destroy();

// it helps to rediret to index page 
header("Location: index.php");
exit();
?>
