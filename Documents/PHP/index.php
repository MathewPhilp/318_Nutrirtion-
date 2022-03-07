<?php
session_start();
 
require_once "../../Database/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../CSS/styles.css ">
  <link rel="script" href="../JS/button-script.js">
  <script src="../JS/button-script.js" defer></script>
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
      <a href="#">Monthly Packages</a>
      <a href="# ">Couples Nutrition</a>
      <a href="#">Adolescent Nutrition</a>
      <a href="#">Workshops/Seminars</a>
    </div>
    </div>
        <li><a href="../PHP/login.php">MY PLAN</a></li>
        <div class="contact">
          <li><a href="#">CONTACT</a></li>
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
    <p><span style="font-size:24px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="column-33">
    <img src="../../Images/ref1.jpg" width="248px" height="372px" style="border-radius: 2%;">
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="column-33">
    <img src="../../Images/ref1.jpg" width="248px" height="372px"  style="border-radius: 2%;">
    </div>
    <div class="column-66">
      <h1 style=" text-align: center; font-size: 24px;"><b>Hello</b></h1>
    <p><span style="font-size:24px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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