<?php
// Start the session to access session variables
session_start();

// Unset all session variables to clear the session data
session_unset(); 

// Destroy the session to remove all session data and cookies
session_destroy(); 

// Redirect the user to the login page after logging out
header("Location: loginPage.php");
exit; // Ensure the script stops executing after the redirect
?>
