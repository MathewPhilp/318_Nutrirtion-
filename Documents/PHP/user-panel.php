<!-- ##################################################################################
#Script Name: Admin panel
#Description: Admin functions
#Author: Mathew Philp
#Date: 2022-03-02
################################################################################## -->
<?php
session_start();

require_once "../../Database/config.php";

// Check if the user is logged in, if not then redirect them to the login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}

// if ($_SESSION["Active"] == false)
// {
//   header("location: ../PHP/account-sign-out.php");
//   echo 'Not logged in';
// }


$currentTime = date("h:i:sa");
$time = strtotime($currentTime);


if ($currentTime >= "05:00:00am" && $currentTime < "11:59:59am")
{
  $welcome_msg = "Good Morning,  ";

}
 if ($currentTime >= "00:00:00pm" && $currentTime < "05:00:00pm" )
{
  $welcome_msg = "Good Afternoon,  ";
}
 if ($currentTime >= "00:00:00am" && $currentTime < "05:00:00am" || $currentTime >= "05:00:00pm")
{
  $welcome_msg = "Good Evening,  ";
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
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | <?php echo htmlspecialchars($_SESSION["FName"]);?> <?php echo htmlspecialchars($_SESSION["LName"]); ?></title>
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
    <div class="dropdown">
        <li><a class="dropbtn" href="../PHP/admin-panel.php">MY PLAN</a></li>
        <div class="dropdown-content">
      <a href="../PHP/account-sign-out.php">Log Out</a>
    </div>
    </div>
        <div class="contact">
          <li><a href="../PHP/contact.php">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>

  <div class="panel">
    <h1 class="my-5 welcome-message"><?php echo $welcome_msg; ?> <b><?php echo htmlspecialchars($_SESSION["FName"]);?>  <?php echo htmlspecialchars($_SESSION["LName"]); ?></b></h1>
    <h1 class="account-id"> Account ID: <?php echo htmlspecialchars($_SESSION["ACC_ID"])?></h1>

    </div>

    <div class="container-panel-3">
    <div class="row">
    <div class="column-3" id="blue">
      <h1>Total Users: <?php
        echo $link->query("SELECT COUNT(*) FROM Accounts")->fetch_column();
        ?></h1>

      </div>

      <div class="column-3" id="pink">
      <h1>Journals: <?php
        echo $link->query("SELECT COUNT(*) FROM Journal")->fetch_column();
        ?> </h1>

      </div>

      <div class="column-3" id="green">
      <h1>Mailbox: 0</h1>

      </div>

      
  </div>



  <div class="container-icons">
    <div class="row">
    <div onclick="location.href='../../Documents/PHP/new-journal.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/users-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/new-journal.php">New Entry</a></span>
    </div>
    
    <div onclick="location.href='../PHP/view-journals.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/Support-Bubble-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../PHP/view-journals.php">View Journals</a></span>
    </div>


    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/user-edit-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">Edit Profile</a></span>
    </div>


  </div>
  </div>

  


  




</body>



</html>
