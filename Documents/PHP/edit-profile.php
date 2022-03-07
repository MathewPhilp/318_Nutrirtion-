<!-- ##################################################################################
#Script Name: Edit profile
#Description: User can update profile settings
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->
<?php
session_start();
require_once "../../Database/config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}
?>

<?php

// Declaring Variables
$firstname = $lastname = $phone = $employee = $email = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

$id = $_SESSION["ACC_ID"];

$result = $link->query("SELECT * FROM `Accounts` WHERE ACC_ID ='$id'");

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="script" href="../JS/button-script.js">
  <link rel="stylesheet" href="../CSS/boot-strap.css ">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | ADMIN PANEL</title>
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
        <li><a href="#">ABOUT 318</a></li>
      <div class="dropdown">
        <li><a class="dropbtn" href="#">PROGRAMS</a></li>
        <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="# ">Link 2</a>
      <a href="#">Link 3</a>
    </div>
    </div>
    <div class="dropdown">
        <li><a class="dropbtn" href="../../Documents/PHP/admin-panel.php">MY PLAN</a></li>
        <div class="dropdown-content">
      <a href="../PHP/account-sign-out.php">Log Out</a>
    </div>
    </div>
        <div class="contact">
          <li><a href="#">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>

				<?php while ($row = $result->fetch_assoc()):?>

				<?php
				$employee = $row['Employee'];
				$firstname = $row['FName'];
				$lastname = $row['LName'];
				$phone = $row['Phone'];
				$email = $row['Email'];
				$_SESSION["temp"] = $row['ACC_ID'];
			
			endwhile; ?>
			</table>
			<div class="wrapper">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Account ID</label>
                <input type="text" name="ACC_ID" class="form-control" readonly="readonly" value="<?php echo $id; ?>">
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="FName" class="form-control" placeholder="Not filled by user"<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="LName" class="form-control" placeholder="Not filled by user"<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
            </div>
            <div class="form-group">
                <label>Phone #</label>
                <input type="text" name="Phone" class="form-control" placeholder="Not filled by user" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="Email" placeholder="Not filled by user" class="form-control"  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <br>          
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Change">
                <input type="reset" class="btn btn-secondary ml-2" value="Revert">
								<a href="../Admin Panel/reset-password.php" class="btn btn-danger">Change Password</a>
            </div>
        </form>
				</div>		
		</body>

<footer>
  <div class="footer">
    <div class="button-format">
    <a href="#">CONTACT ME</a>
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
		$tw = $_SESSION["temp"];
    $new_fname = $_POST['FName'];
		$new_lname = $_POST['LName'];
		$new_phone = $_POST['Phone'];
		$new_email = $_POST['Email'];
		$new_employee = $_POST['question'];
    $result = $link->query("UPDATE Accounts SET FName='$new_fname', LName='$new_lname', Phone='$new_phone', Email='$new_email' WHERE ACC_ID='$tw'");
    if ($_SESSION["Employee"] == true)
    {
      header("location: ../../../Admin Panel/admin-panel.php");
      exit;
    }
    else if ($_SESSION["Employee"] == false)
    {
      header("location: ../../../PHP Scripts/Home.php");
      exit;
    }
}
?>








