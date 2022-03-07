<!-- ##################################################################################
#Script Name: Login Script
#Description: Validates login input with Database credentials
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->

<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect them to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    if ($_SESSION["Employee"] == true)
    {
    header("location: ../../Documents/PHP/admin-panel.php");
    exit;
    }
    else if ($_SESSION["Employee"] == false)
    {
        header("location: ../../Documents/PHP/login.php");
        exit;
    }
}

require_once "../../Database/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if username is empty
    if(empty(trim($_POST["Email"])))
    {
        $username_err = "Please enter username.";
    } 
    else
    {
        $username = trim($_POST["Email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["Password"])))
    {
        $password_err = "Please enter your password.";
    } 
    else
    {
        $password = trim($_POST["Password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
        $sql = "SELECT ACC_ID, Employee, FName, LName, Email, Password FROM Accounts WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1)
                {                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $employee, $name, $surname, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["ACC_ID"] = $id;
                            $_SESSION["Email"] = $username;
                            $_SESSION["FName"] = $name;
                            $_SESSION["LName"] = $surname;
                            $_SESSION["Employee"] = $employee;

                            if ($employee == 1)
                            {
                                header("location: ../../Documents/PHP/admin-panel.php");
                            }
                            else
                            {
                                header("location: ../../../PHP Scripts/Home.php");
                            }
                            
                            
                            // Redirect user to welcome page
                            

                            
                        } 
                        else
                        {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid email or password.";
                        }
                    }
                } 
                else
                {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid email or password.";
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <link rel="script" href="../JS/button-script.js">
<link rel="stylesheet" href="../CSS/boot-strap.css ">
  <link rel="stylesheet" href="../CSS/styles.css ">
  <style>
        .wrapper
        { 
            width: 360px; 
            height:  padding: 20px;
            margin: 0 auto;
        }
    </style>

  <script src="../JS/button-script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>318 Nutrition | Login</title>
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
        <li><a href="#">MY PLAN</a></li>
        <div class="contact">
          <li><a href="#">CONTACT</a></li>
        </div>
      </ul>
    </div>
  </nav>


<body>
<div class="hero-image">
  <div class="hero-text">
    <h1>Suttie 318</h1>
  </div>
</div>
<br><br><br><br>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err))
        {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="Email" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>

<br><br><br><br>
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
