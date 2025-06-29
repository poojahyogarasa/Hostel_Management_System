<?php
session_start();
session_unset(); // Optional: Clears all session variables
session_destroy(); // Destroys the session
header("Location: index.php"); // Redirects to the welcome page
exit();
?>
