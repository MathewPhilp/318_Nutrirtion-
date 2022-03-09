<!-- ##################################################################################
#Script Name: Update journal 
#Description: Updates existing journal entry
#Author: Mathew Philp
#Date: 2022-03-01
################################################################################## -->
<?php
ob_start();
session_start();
require_once "../../Database/config.php";
$var_value = $_GET['varname'];

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}
?>
<?php



// Gets current Date
$date = date("Y-m-d");

// Grabs Current Session account ID
$id = $_SESSION["ACC_ID"];

$result = $link->query("SELECT * FROM `Journal` WHERE ACC_ID ='$id' AND J_EntryData='$var_value'");

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
        <li><a href="../PHP/login.php">MY PLAN</a></li>
        <div class="contact">
          <li><a href="../PHP/contact.php">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>

  <h1 class="account-id"> Account ID: <?php echo htmlspecialchars($_SESSION["ACC_ID"])?></h1>

  <?php while ($row = $result->fetch_assoc()):?>
    <?php
    $journal_id = $row['ENT_ID'];
    $entrydate = $row['J_EntryData'];
    $energylevel = $row['J_EnergyLevel'];
    $weight = $row['J_Weight'];
    $meals = $row['J_MealsEaten'];
    $notes = $row['J_ExericeNotes'];
    endwhile; ?>

			<div class="wrapper">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Entry Date</label>
                <input type="date" name="entrydate" class="form-control" readonly="readonly" value="<?php echo $var_value; ?>">
            </div>
            <div class="form-group">
                <label>Energy Level</label>
                <input type="text" name="energylevel" class="form-control" required value="<?php echo $energylevel; ?>">
            </div>
            <div class="form-group">
                <label>Weight</label>
                <input type="text" name="weight" class="form-control" placeholder="pounds" required value="<?php echo $weight; ?>">
            </div>
            <div class="form-group">
                <label>Meals Eaten</label>
                <input type="text" name="meals" class="form-control" required value="<?php echo $meals; ?>">
            </div>
            <div class="form-group">
                <label>Exercise Notes</label>
                <textarea name="notes" class="form-control" rows="4" cols="50"value="" required><?php echo $notes; ?></textarea>
            </div>
            <br>          
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                <a onclick="return checkDelete()" href="../PHP/delete-journal-entry.php?journalid=<?php echo $journal_id ?>"class="btn btn-danger">Delete Entry</a>
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


<?php
if(isset($_POST['submit']))
{
    $entrydate = $_POST['entrydate'];
		$energylevel = $_POST['energylevel'];
		$weight = $_POST['weight'];
		$meals = $_POST['meals'];
		$notes = $_POST['notes'];
    $result = $link->query("UPDATE Journal SET J_EntryData='$entrydate', J_EnergyLevel='$energylevel', J_Weight='$weight', J_MealsEaten='$meals', J_ExericeNotes='$notes' WHERE ACC_ID='$id' AND J_EntryData='$entrydate'");
    header("location: ../PHP/view-journals.php");

}
?>