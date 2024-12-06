<?php
// Start session and destroy it
session_start();
session_unset();
session_destroy();

// Redirect to the login page
header("Location: signin.html");
exit();
?>
