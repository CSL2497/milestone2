<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Delete the login cookie
setcookie('login', '', time() - 3600, '/');

// Redirect to login page
header('Location: http://localhost/demo/login_form.php');
exit;
?>