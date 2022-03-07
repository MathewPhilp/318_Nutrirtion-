<!-- ##################################################################################
#Script Name: List Accounts
#Description: Displays and fetches accounts from database
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->
<?php
session_start();
require_once "../../Database/config.php";


if ($_SESSION["Employee"] == false)
{
    header("location: ../../../PHP Scripts/Home.php");
    exit;
}
?>
<?php



// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('ACC_ID', 'Employee', 'FName','LName', 'Phone', 'Email');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

$count = 0;
// Get the result...
if ($result = $link->query
('SELECT *,
 CASE WHEN Employee = 1 THEN "Yes"
 ElSE "No" 
 END AS EmployeeText 
 FROM accounts 
 ORDER BY ' .  $column . ' ' . $sort_order . ' ' . '' . ' '. '')) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';

  if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $result = $link->query("SELECT *, CASE WHEN Employee = 1 THEN 'Yes' ElSE 'No' END AS EmployeeText  FROM `Accounts` WHERE CONCAT(UPPER(Email), UPPER(FName), UPPER(LName), `Phone`, `ACC_ID`) LIKE '%".$valueToSearch."%'");

}
else
{
  $result = $link->query('SELECT *,
  CASE WHEN Employee = 1 THEN "Yes"
  ElSE "No" 
  END AS EmployeeText 
  FROM accounts 
  ORDER BY ' .  $column . ' ' . $sort_order . ' ' . '' . ' '. '');
  
}
if (isset($_POST['reset']))
{
  $result = $link->query('SELECT *,
  CASE WHEN Employee = 1 THEN "Yes"
  ElSE "No" 
  END AS EmployeeText 
  FROM accounts 
  ORDER BY ' .  $column . ' ' . $sort_order . ' ' .  '');

}

$currentDate = date("h:i:sa");

?>

<!DOCTYPE html>
<html lang="en">
<head>
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
  <title>318 Nutrition | HOME</title>
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
        <li><a href="../PHP/login.php">MY PLAN</a></li>
        <div class="contact">
          <li><a href="#">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>

  <form class="" action="view-accounts.php" method="post">
            <input class="mover-search" type="text" name="valueToSearch" placeholder="Search">
            <input class="mover-search" type="submit" name="search" value="Search">
            <input class="mover-search" type="submit" name="reset" value="Reset">
		</form>
			<table id="myTable">
				<tr>
					<th><a href="accounts.php?column=ACC_ID&order=<?php echo $asc_or_desc; ?>">ID<i class="fas fa-sort<?php echo $column == 'ACC_ID' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="accounts.php?column=Employee&order=<?php echo $asc_or_desc; ?>">Employee<i class="fas fa-sort<?php echo $column == 'Employee' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="accounts.php?column=FName&order=<?php echo $asc_or_desc; ?>">First Name<i class="fas fa-sort<?php echo $column == 'FName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="accounts.php?column=LName&order=<?php echo $asc_or_desc; ?>">Last Name<i class="fas fa-sort<?php echo $column == 'LName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
          <th><a href="accounts.php?column=Phone&order=<?php echo $asc_or_desc; ?>">Phone<i class="fas fa-sort<?php echo $column == 'Phone' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="accounts.php?column=Email&order=<?php echo $asc_or_desc; ?>">Email<i class="fas fa-sort<?php echo $column == 'Email' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a>Modify</a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
					
				<tr>
					<td<?php echo $column == 'ACC_ID' ? $add_class : ''; ?>><?php echo $row['ACC_ID']; ?></td>
          <td<?php echo $column == 'Employee' ? $add_class : ''; ?>><?php echo $row['EmployeeText']; ?></td>
					<td<?php echo $column == 'FName' ? $add_class : ''; ?>><?php echo $row['FName']; ?></td>
          <td<?php echo $column == 'LName' ? $add_class : ''; ?>><?php echo $row['LName']; ?></td>
          <td<?php echo $column == 'Phone' ? $add_class : ''; ?>><?php echo $row['Phone']; ?></td>
					<td<?php echo $column == 'Email' ? $add_class : ''; ?>><?php echo $row['Email']; ?></td>
					<td><a href="../Admin Panel/account-details.php" >Edit</a></td>
				</tr>
				<?php endwhile; ?>
			</table>
			<script>
  (function (d) {

     // Get the table element
     var table = function() {
       var tables = d.getElementsByTagName('table');
       return tables[tables.length - 1];
     }();

     table.onclick = function (e) {
       var target = e.target;

       // If an <a> was clicked
       if( target.nodeName.toLowerCase() === 'a' ) {

         // Find the tr containing that a
         var node = target;
         while (node.nodeName.toLowerCase() !== 'tr' )
           node = node.parentNode;
         var tr = node;

         // Output the contents of the table cells in that row
         var cells = tr.cells;
         for (var i = 0; i < 1; i++ )
						 var acc_id = (cells[0].innerHTML);
						 console.log(acc_id);

         // Return false to prevent the link from loading
         return true;
       }
     }
  })(document)
</script>

			
		</body>
	</html>
	<?php
	$result->free();
}
?>

  




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