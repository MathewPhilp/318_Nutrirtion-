<!-- ##################################################################################
#Script Name: Account Details
#Description: Allows admin level of account editing
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->
<?php
// Initialize the session
session_start();
// Include config file
require_once "../../Database/config.php";
$accountID = $_GET['varname'];

// Check if user is Employee
if ($_SESSION["Employee"] == false) {
  header("location: ../PHP/user-panel.php");
  exit();
}
?>

<?php
// For extra protection these are the columns of which the user can sort by.
$columns = [
  "ACC_ID",
  "Employee",
  "FName",
  "LName",
  "Phone",
  "Email",
  "Password",
];

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column =
  isset($_GET["column"]) && in_array($_GET["column"], $columns)
    ? $_GET["column"]
    : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order =
  isset($_GET["order"]) && strtolower($_GET["order"]) == "desc"
    ? "DESC"
    : "ASC";

// Some variables we need for the table.
$firstname = $lastname = $phone = $employee = $email = $password = $confirm_password =
  "";
$username_err = $password_err = $confirm_password_err = "";
$searchHasBeenPressed = false;
$up_or_down = str_replace(["ASC", "DESC"], ["up", "down"], $sort_order);
$asc_or_desc = $sort_order == "ASC" ? "desc" : "asc";
$add_class = ' class="highlight"';

$result = $link->query("SELECT *,CASE WHEN Employee = 1 THEN 'Yes'ElSE 'No' END AS EmployeeText, CASE WHEN Active = 1 THEN 'Active' ELSE 'Inactive' END AS ActiveText FROM Accounts WHERE ACC_ID='$accountID'");
?>

<?php 
if (isset($_POST["Activate"])) 
{
  $cacheID = $_SESSION["cacheID"];
  $active = true;
  $result = $link->query("UPDATE Accounts SET Active='$active' WHERE ACC_ID='$cacheID'");
  header("location: ../PHP/view-accounts.php");
  exit;
}

if (isset($_POST["Deactivate"])) 
{
  $cacheID = $_SESSION["cacheID"];
  $active = false;
  $result = $link->query("UPDATE Accounts SET Active='$active' WHERE ACC_ID='$cacheID'");
  header("location: ../PHP/view-accounts.php");
  exit;
}


if (isset($_POST["submit"])) 
{
  $cacheID = $_SESSION["cacheID"];
  $new_fname = $_POST["FName"];
  $new_lname = $_POST["LName"];
  $new_phone = $_POST["Phone"];
  $new_email = $_POST["Email"];
  $new_employee = $_POST["question"]; 
  $result = $link->query("UPDATE Accounts SET FName='$new_fname', LName='$new_lname', Phone='$new_phone', Email='$new_email', Employee='$new_employee' WHERE ACC_ID='$cacheID'");
  header("location: ../PHP/view-accounts.php");
  exit;
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Links Favicon's -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../Images/Favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../Images/Favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../Images/Favicon/favicon-16x16.png">
  <link rel="manifest" href="../../Images/Favicon/site.webmanifest">
  <!-- Links CSS/JS Scripts -->
  <link rel="stylesheet" href="../CSS/boot-strap.css ">
  <link rel="script" href="../JS/button-script.js">
  <link rel="script" href="../JS/button-script.js">
  <link rel="stylesheet" href="../CSS/table-format.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="../JS/button-script.js" defer></script>
  <link rel="stylesheet" href="../CSS/styles.css ">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | Edit Users</title>
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
        <li><a href="../PHP/macro-calculator.php">MACRO CALCULATOR</a></li>
        <?php if (isset($_SESSION["loggedin"]) == true) {
          echo '<div class="dropdown">
                <li><a class="dropbtn" href="../PHP/admin-panel.php">MY PLAN</a></li>
                <div class="dropdown-content">
                <a href="../PHP/account-sign-out.php">Log Out</a>
                </div>
                </div>';
        } else {
          echo '<li><a href="../PHP/admin-panel.php">MY PLAN</a></li>';
        } ?> 
        <div class="contact">
          <li><a href="../PHP/contact.php">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>
  <body>
    <!-- Data Table -->
			<table id="myTable">
				<tr>
					<th><a>ID</a></th>
          <th><a>Employee</a></th>
          <th><a>Active</a></th>
					<th><a>First Name</a></th>
          <th><a>Last Name</a></th>
          <th><a>Phone</a></th>
					<th><a>Email</a></th>
					<th><a>Nutrition Plan</a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
					
				<tr>
					<td<?php echo $column == "ACC_ID" ? $add_class : ""; ?>><?php echo $row["ACC_ID"]; ?></td>
          <td<?php echo $column == "Employee"? $add_class : ""; ?>><?php echo $row["EmployeeText"]; ?></td>
          <td<?php echo $column == "Active"? $add_class : ""; ?>><?php echo $row["ActiveText"]; ?></td>
					<td<?php echo $column == "FName" ? $add_class : ""; ?>><?php echo $row["FName"]; ?></td>
          <td<?php echo $column == "LName"? $add_class : ""; ?>><?php echo $row["LName"]; ?></td>
          <td<?php echo $column == "Phone"? $add_class : ""; ?>><?php echo $row["Phone"]; ?></td>
					<td<?php echo $column == "Email" ? $add_class : ""; ?>><?php echo $row["Email"]; ?></td>
					<td<?php echo $column == "Nutrition Plan"; ?>><a href='#<?php echo $row["NutritionPlan"]; ?>'><?php echo $row["NutritionPlan"]; ?></a></td>
					
				</tr>
				<?php
    $active = $row["Active"];
    $employee = $row["Employee"];
    $firstname = $row["FName"];
    $lastname = $row["LName"];
    $phone = $row["Phone"];
    $email = $row["Email"];
    $nutritionplan = $row["NutritionPlan"];
    $_SESSION["cacheID"] = $row["ACC_ID"];
    endwhile; ?>
			</table>
			<div class="wrapper">
      <form action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]
      ); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="FName" class="form-control" placeholder="Not filled by user"<?php echo !empty(
                  $username_err
                )
                  ? "is-invalid"
                  : ""; ?>" value="<?php echo $firstname; ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="LName" class="form-control" placeholder="Not filled by user"<?php echo !empty(
                  $username_err
                )
                  ? "is-invalid"
                  : ""; ?>" value="<?php echo $lastname; ?>">
            </div>
            <div class="form-group">
                <label>Phone #</label>
                <input type="text" name="Phone" class="form-control" placeholder="Not filled by user" <?php echo !empty(
                  $username_err
                )
                  ? "is-invalid"
                  : ""; ?>" value="<?php echo $phone; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="Email" placeholder="Not filled by user" class="form-control"  <?php echo !empty(
                  $username_err
                )
                  ? "is-invalid"
                  : ""; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>          
            <div class="form-group">
                <label>Employee?</label><br>
                <input type="radio" id="yes" name="question" value=1<?php if (
                  $employee == 1
                ) { ?>
									checked="<?php echo "checked"; ?>
									<?php } ?> ">
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="question" value=""<?php if (
                  $employee == "0"
                ) { ?>
									checked="<?php echo "checked"; ?>
									<?php } ?> ">
                <label for="no">No</label><br>
            </div>
						<!-- <div class="form-group">
                <label>Nutrirtion Plan</label>
								<input type="file" name="myfile" class="form-control" value="<?php echo $nutritionplan; ?>">
            </div>     -->
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Change">&nbsp;
                <input type="reset" class="btn btn-secondary ml-2" value="Revert">&nbsp;
								<a href="../Admin Panel/reset-password.php" class="btn btn-danger">Change Password</a>&nbsp;
								<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="return checkDelete()" href="../Admin Panel/remove-user.php" class="btn btn-danger">Delete Account</a>
                <?php 

                if($active == 0)
                {
                  echo '<input type="submit" name="Activate" class="btn btn-activate" value="Activate">&nbsp;';
                }
                if($active == 1)
                {
                  echo '<input type="submit" name="Deactivate" class="btn btn-deactivate" value="Deactivate">&nbsp;';
                }
                ?>
                
            </div>
        </form>
				</div>
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
	<?php $result->free(); ?>

