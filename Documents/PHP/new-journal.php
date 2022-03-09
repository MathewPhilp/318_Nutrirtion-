<!-- ##################################################################################
#Script Name: Journal
#Description: User creates journal and submits it to database
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->
<?php
ob_start();
session_start();
require_once "../../Database/config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}



?>
<?php


$date = date("Y-m-d");

$id = $_SESSION["ACC_ID"];
$journal_err = false;



$entrydate = null;

$result = $link->query("SELECT * FROM `Accounts` WHERE ACC_ID ='$id'");


if(isset($_POST['submit']))
{
    $entrydate = $_POST['entrydate'];
		$energylevel = $_POST['energylevel'];
		$weight = $_POST['weight'];
		$meals = $_POST['meals'];
		$notes = $_POST['notes'];

    $result = $link->query("SELECT * FROM Journal WHERE J_EntryData = '$entrydate' AND ACC_ID ='$id'");

    if (mysqli_num_rows($result) == 0) 
    { 
      $result = $link->query("INSERT INTO Journal (ACC_ID, J_EntryData, J_MealsEaten, J_Weight, J_EnergyLevel, J_ExericeNotes) VALUES ('$id', '$entrydate', '$energylevel', '$weight', '$meals', '$notes')");

      header("location: ../../Documents/PHP/admin-panel.php");
      exit;
   } 
   else 
   { 
    $journal_err = true;
    echo "Nope";
    echo $journal_err;
   }  
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="apple-touch-icon" sizes="180x180" href="../../Images/Favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../Images/Favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../Images/Favicon/favicon-16x16.png">
<link rel="manifest" href="../../Images/Favicon/site.webmanifest">
<link rel="script" href="../JS/button-script.js">
<link rel="stylesheet" href="../CSS/boot-strap.css ">
<link rel="stylesheet" href="../CSS/table-format.css">
<link rel="script" href="../JS/button-script.js">
<script src="../JS/button-script.js" defer></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | New Journal</title>
</head>
<body>
  <nav class="navbar">
    <div onclick="location.href='../../Documents/PHP/index.php';" style="cursor: pointer;" class="brand-title">318 Nutrition</div>
    <a href="#" class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <ul>
        <li><a href="../../Documents/PHP/index.php">HOME</a></li>
        <li><a href="../PHP/about.php">ABOUT 318</a></li>
      <div class="dropdown">
        <li><a class="dropbtn" href="../../Documents/PHP/programs.php">PROGRAMS</a></li>
        <div class="dropdown-content">
      <a href="#">Monthly Packages</a>
      <a href="# ">Couples Nutrition</a>
      <a href="#">Adolescent Nutrition</a>
      <a href="#">Workshops/Seminars</a>
    </div>
    </div> 
    <?php
        if(isset($_SESSION["loggedin"]) == true)  
        {
          echo '<div class="dropdown">
                <li><a class="dropbtn" href="../PHP/admin-panel.php">MY PLAN</a></li>
                <div class="dropdown-content">
                <a href="../PHP/account-sign-out.php">Log Out</a>
                </div>
                </div>';
        }
        else 
        {
         echo '<li><a href="../PHP/admin-panel.php">MY PLAN</a></li>';
        }
?>
        <div class="contact">
          <li><a href="../PHP/contact.php">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>

  

  <h1 class="account-id"> Account ID: <?php echo htmlspecialchars($_SESSION["ACC_ID"])?></h1>

			<div class="wrapper">
        <?php if($journal_err == true)
          echo '<p class="journal-warning">Journal entry already filled for </p>';
          echo "<p class='journal-warning'>$entrydate</p>";
          ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="entrydate" class="form-control"  value="<?php echo $date  ?>">
            </div>
            <div class="form-group">
                <label>Energy Level Today</label>
                <input type="text" name="energylevel" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Current Weight</label>
                <input type="text" name="weight" class="form-control" placeholder="pounds" required >
            </div>
            <div class="form-group">
                <label>Meal had today</label>
                <input type="text" name="meals" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Exercise Notes</label>
                <textarea name="notes" class="form-control" rows="4" cols="50" required></textarea>
            </div>
            <br>          
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
				</div>	
		</body>
    <footer>
  <div class="footer">
    <div class="button-format">
    <a href="../PHP/contact.php">CONTACT ME</a>
    </div>
    <br>
  <p>Copyright © 318 Nutrition<br></p>
</div>
</footer>
	</html>
	<?php
	$result->free();
?>


