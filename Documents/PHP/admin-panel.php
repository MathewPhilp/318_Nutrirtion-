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

if ($_SESSION["Employee"] == false)
{
    header("location: ../../../Admin Panel/user-panel.php");
    exit;
}

$currentTime = date("h:i:sa");
$time = strtotime($currentTime);


if ($currentTime >= "05:00:00am" && $currentTime < "12:00:00pm")
{
  $welcome_msg = "Good Morning, ";

}
else if ($currentTime >= "00:00:00pm" && $currentTime < "05:00:00pm" )
{
  $welcome_msg = "Good Afternoon, ";
}
else if ($currentTime >= "05:00:00pm" && $currentTime < "05:00:00am" )
{
  $welcome_msg = "Good Evening, ";
}


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
        <li><a class="dropbtn" href="#">MY PLAN</a></li>
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

  <div class="panel">
    <h1 class="my-5"><?php echo $welcome_msg; ?> <b><?php echo htmlspecialchars($_SESSION["FName"]);?>  <?php echo htmlspecialchars($_SESSION["LName"]); ?></b></h1>
    <h1 class="account-id"> Account ID: <?php echo htmlspecialchars($_SESSION["ACC_ID"])?></h1>

    </div>

    <div class="container-panel-3">
    <div class="row">
    <div class="column-3" id="blue">
      <h1>Users</h1>
      <h4>
        <?php
        echo $link->query("SELECT COUNT(*) FROM Accounts")->fetch_column();
        ?>
        </h4>
        <img class="img-icon"src="../../Images/Icons/users-icon.png" width="150px" height="150px">
      </div>&nbsp;&nbsp;

      <div class="column-3" id="pink">
      <h1>Journals</h1>
      <h4>
        <?php
        echo $link->query("SELECT COUNT(*) FROM Journal")->fetch_column();
        ?>
        </h4>
        <img class="img-icon"src="../../Images/Icons/Support-Bubble-icon.png" width="170px" height="170px">
      </div>&nbsp;&nbsp;&nbsp;

      <div class="column-3" id="green">
      <h1>Mailbox</h1>
      <h4>0
        </h4>
        <img class="img-icon"src="../../Images/Icons/Email-icon.png" width="170px" height="170px">
      </div>

      
  </div>

  <div class="container-icons">
    <div class="row">
    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/users-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">View Accounts</a></span>
    </div>
    
    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/Support-Bubble-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">View Accounts</a></span>
    </div>

    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/user-edit-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">Edit Account</a></span>
    </div>

    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/Books-2-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">View Journals</a></span>
    </div>

    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/Books-2-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">View Journals</a></span>
    </div>

    <div onclick="location.href='../../Documents/PHP/edit-profile.php';" style="cursor: pointer;"  class="icon-button">
    <img class="img-icon-2"src="../../Images/Icons/Books-2-icon.png" width="85px" height="85px">
    <br>
    <span class="button-text"><a href="../../Documents/PHP/edit-profile.php">View Journals</a></span>
    </div>

  </div>
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