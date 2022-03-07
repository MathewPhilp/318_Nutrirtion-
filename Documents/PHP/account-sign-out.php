<!-- ##################################################################################
#Script Name: Sign out of Session
#Description: User signs out of current session
#Author: Mathew Philp
#Date: 2022-03-02
################################################################################## -->

<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: ../PHP/index.php ");
exit;
?>