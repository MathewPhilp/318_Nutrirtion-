<!-- ##################################################################################
#Script Name: Remove Journal
#Description: Allows users to delete journal entry
#Author: Mathew Philp
#Date: 2022-03-02
################################################################################## -->

<?php
session_start();
require_once "../../Database/config.php";

$journal_id = $_GET['journalid'];




// sql to delete a record
$sql = "DELETE FROM Journal WHERE ENT_ID='$journal_id'";


if (mysqli_query($link, $sql)) 
{

  header("location: ../PHP/user-panel.php");
  
  
 
} 
else
 {
  echo "Error deleting record: " . mysqli_error($link);
}


mysqli_close($link);


?>