<?php


session_start();

// remove all session variables
unset($_SESSION[id]);
//session_unset();

// destroy the session
//session_destroy();

header('location:index.php?msg=success_logout');

?>