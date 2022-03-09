<!-- ##################################################################################
#Script Name: Account Creation Script
#Description: Creates an account within the database
#Author: Mathew Philp
#Date: 2022-02-27
################################################################################## -->

<?php
session_start();
require_once "../../Database/config.php";

if ($_SESSION["Employee"] == false)
{
    header("location: ../../Documents/PHP/index.php");
    exit;
}
 
// Define variables and initialize with empty values
$firstname = $lastname = $phone = $employee = $email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    // Validate email
    if(empty(trim($_POST["Email"])))
    {
        $email_err = "Please enter a Email.";
    }
    elseif(!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL))
    {
      $email_err = "Must be a valid email Address";
    } 
    else
    {
        // Prepare statement
        $sql = "SELECT ACC_ID FROM Accounts WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_email);
            
          // Set parameters
          $param_email = trim($_POST["Email"]);
            
          // Attempt to execute statement
          if(mysqli_stmt_execute($stmt))
          {

            mysqli_stmt_store_result($stmt);
                
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
              $email_err = "This email is already taken.";
            } 
            else
            {
              $email = trim($_POST["Email"]);
            }
          } 
          else
          {
            echo "Oops! Something went wrong. Please try again later.";
          }
          mysqli_stmt_close($stmt);
        }
    }
    
    // Validate First Name
    $firstname = trim($_POST["FName"]);

    // Validate last Name
    $lastname = trim($_POST["LName"]);

    // Validate Phone number
    $phone = trim($_POST["Phone"]);
      
    // Validate Employee Status
    $employee = trim($_POST["question"]);
    

    // Validate password
    if(empty(trim($_POST["Password"])))
    {
      $password_err = "Please enter a password.";     
    } 
    elseif(strlen(trim($_POST["Password"])) < 6)
    {
      $password_err = "Password must have atleast 6 characters.";
    } 
    else
    {
      $password = trim($_POST["Password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
      $confirm_password_err = "Please confirm password.";     
    } 
    else
    {
      $confirm_password = trim($_POST["confirm_password"]);
      if(empty($password_err) && ($password != $confirm_password))
      {
        $confirm_password_err = "Password did not match.";
      }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err))
    {
        
      // Prepare an insert statement
      $sql = "INSERT INTO Accounts (Employee, FName, LName, Phone, Email, Password) VALUES (?, ?, ?, ?, ?, ?)";
         
      if($stmt = mysqli_prepare($link, $sql))
      {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $param_employee, $param_firstname, $param_lastname, $param_phone, $param_email, $param_password);
            
        // Set parameters
        $param_firstname = $firstname;
        $param_lastname = $lastname;
        $param_phone = $phone;
        $param_employee = $employee;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
        // Attempt to execute
        if(mysqli_stmt_execute($stmt))
        {
          // Redirect to login page
          header("location: ../../PHP/index.php");
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
  <title>318 Nutrition | Create Account</title>
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

  <div class="wrapper">
        <h2>Account Creation</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="FName" class="form-control">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="LName" class="form-control">
            </div>
            <div class="form-group">
                <label>Phone #</label>
                <input type="text" name="Phone" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>          
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Employee?</label><br>
                <input type="radio" id="yes" name="question" value=1>
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="question" value="" checked="checked">
                <label for="no">No</label><br>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
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