<?php
session_start();
 
require_once "../../Database/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="../../Images/Favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../Images/Favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../Images/Favicon/favicon-16x16.png">
  <link rel="manifest" href="../../Images/Favicon/site.webmanifest">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | Home</title>
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

  <div class="hero-image">
  <div class="hero-text">
    <h1>Suttie 318</h1>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="column-66">
    <h1 style=" text-align: center; font-size: 24px;"><b>Hello</b></h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="column-33">
    <img src="../../Images/ref1.jpg" class="statement-image">
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="column-33">
    <img src="../../Images/ref1.jpg" class="statement-image">
    </div>
    <div class="column-66">
      <h1 style=" text-align: center; font-size: 24px;"><b>Hello</b></h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
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