<!-- ##################################################################################
#Script Name: Employee/Customer - View Journal Entrys
#Description: Employee or Customer can view Journal Entrys. Customers can ONLY view their entrys.
#Author: Mathew Philp
#Date: 2022-03-02
################################################################################## -->

<?php
session_start();
require_once "../../Database/config.php";


// Checks to see if your loggedin. If not redirects you to the login page.
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
	header("location: ../../Admin Panel/login.php");
	exit;
}
?>


<?php

// For extra protection these are the columns of which the user can sort by.
$columns = array('ENT_ID','ACC_ID', 'J_EntryData', 'J_MealsEaten','J_Weight', 'J_Energylevel', 'J_ExericeNotes');

// Only get the column if it exists in the above columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the current Date.
$date = date("Y-m-d");

// Get the date a month back from the above date.
$date_MonthBack = date("Y-m-d", strtotime("$date -1 month"));



// Get the results.
if ($result = $link->query("SELECT * FROM Journal WHERE J_EntryData BETWEEN '$date_MonthBack' AND '$date' ORDER BY  ' .  $column . ' ' . $sort_order . ' ' . '' . ' '. '"))
{
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';

	

	if(isset($_POST['search']))
	{
		if ($_SESSION["Employee"] == true)
		{
    $firstDateToSearch = $_POST['firstDateToSearch'];
    $secondDateToSearch = $_POST['secondDateToSearch'];
		$date_MonthBack = $firstDateToSearch;
		$date = $secondDateToSearch;
    $result = $link->query("SELECT * FROM `Journal` WHERE J_EntryData BETWEEN '$firstDateToSearch' AND '$secondDateToSearch'" );
		}
		else
		{
			$id = $_SESSION['ACC_ID'];
			$firstDateToSearch = $_POST['firstDateToSearch'];
    	$secondDateToSearch = $_POST['secondDateToSearch'];
			$date_MonthBack = $firstDateToSearch;
			$date = $secondDateToSearch;
    	$result = $link->query("SELECT * FROM Journal WHERE ACC_ID='$id' AND J_EntryData BETWEEN '$firstDateToSearch' AND '$secondDateToSearch' ");

		}

	}
	else
	{
		if ($_SESSION["Employee"] == true)
		{
			$result = $link->query("SELECT * FROM `Journal` WHERE J_EntryData BETWEEN '$date_MonthBack' AND '$date' ORDER BY  '$column'  '$sort_order'");
		}
		else
		{
			$id = $_SESSION['ACC_ID'];
			$result = $link->query("SELECT * FROM `Journal` WHERE J_EntryData BETWEEN '$date_MonthBack' AND '$date' AND ACC_ID='$id' ORDER BY  '$column'  '$sort_order'");
		}
  	
	}

	// When reset button is clicked. Reset to default loading order.
	if (isset($_POST['reset']))
	{
		if ($_SESSION["Employee"] == true)
		{
  		$result = $link->query("SELECT * FROM `Journal` WHERE J_EntryData BETWEEN '$date_MonthBack' AND '$date' ORDER BY  '$column'  '$sort_order'");
		}
		else
		{
			$id = $_SESSION['ACC_ID'];
			$result = $link->query("SELECT * FROM `Journal` WHERE J_EntryData BETWEEN '$date_MonthBack' AND '$date' AND ACC_ID='$id' ORDER BY  '$column'  '$sort_order'");
			
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
  <title>318 Nutrition | View Accounts</title>
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

  <form class="" action="view-journals.php" method="post">
            <input class="mover-search" type="date" name="firstDateToSearch" value="<?php echo $date_MonthBack; ?>">
            <input class="mover-search" type="date" name="secondDateToSearch"value="<?php echo $date; ?>">
            <input class="mover-search" type="submit" name="search" value="Search">
            <input class="mover-search" type="submit" name="reset" value="Reset">
		</form>
			<table id="myTable">
				<tr>
					<th><a href="view-journals.php?column=ENT_ID&order=<?php echo $asc_or_desc; ?>">Journal ID<i class="fas fa-sort<?php echo $column == 'ENT_ID' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=ACC_ID&order=<?php echo $asc_or_desc; ?>">Account ID<i class="fas fa-sort<?php echo $column == 'ACC_ID' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="view-journals.php?column=J_EntryData&order=<?php echo $asc_or_desc; ?>">Entry Date<i class="fas fa-sort<?php echo $column == 'J_EntryData' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_MealsEaten&order=<?php echo $asc_or_desc; ?>">Meals Eaten<i class="fas fa-sort<?php echo $column == 'J_MealsEaten' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_Weight&order=<?php echo $asc_or_desc; ?>">Weight<i class="fas fa-sort<?php echo $column == 'J_Weight' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="view-journals.php?column=J_EnergyLevel&order=<?php echo $asc_or_desc; ?>">Energy Level<i class="fas fa-sort<?php echo $column == 'J_EnergyLevel' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="view-journals.php?column=J_ExericeNotes&order=<?php echo $asc_or_desc; ?>">Exerice Notes<i class="fas fa-sort<?php echo $column == 'J_ExericeNotes' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a>Modify</a></th>
				</tr>

				<!-- A whileloop that fetches and displays all items within the datebase as rows -->
				<?php while ($row = $result->fetch_assoc()): ?>
					
				<tr>
					<td<?php echo $column == 'ENT_ID' ? $add_class : ''; ?>><?php echo $row['ENT_ID']; ?></td>
          <td<?php echo $column == 'ACC_ID' ? $add_class : ''; ?>><?php echo $row['ACC_ID']; ?></td>
					<td<?php echo $column == 'J_EntryData' ? $add_class : ''; ?>><?php echo $row['J_EntryData']; ?></td>
          <td<?php echo $column == 'J_MealsEaten' ? $add_class : ''; ?>><?php echo $row['J_MealsEaten']; ?></td>
          <td<?php echo $column == 'J_Weight' ? $add_class : ''; ?>><?php echo $row['J_Weight']; ?></td>
					<td<?php echo $column == 'J_EnergyLevel' ? $add_class : ''; ?>><?php echo $row['J_EnergyLevel']; ?></td>
          <td<?php echo $column == 'J_ExericeNotes' ? $add_class : ''; ?>><?php echo $row['J_ExericeNotes']; ?></td>
					<?php $var_value = $row['J_EntryData'];
					$_SESSION['varname'] = $var_value;
					?>
					
					<td><a href="../PHP/edit-journal-entry.php?varname=<?php echo $var_value ?>" >Edit</a></td>
				</tr>
				<?php endwhile; ?>
			</table>	
		</body>
	</html>
	<?php
	$result->free();
}
?>

<?php
if(isset($_POST['submit']))
{
    $new_fname = $_POST['FName'];
		$new_lname = $_POST['LName'];
		$new_phone = $_POST['Phone'];
		$new_email = $_POST['Email'];
		$new_employee = $_POST['question'];
    $result = $link->query("UPDATE Accounts SET FName='$new_fname', LName='$new_lname', Phone='$new_phone', Email='$new_email', Employee='$new_employee' WHERE ACC_ID='$tw'");
		

}
?>

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