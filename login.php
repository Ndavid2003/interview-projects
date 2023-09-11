<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once('components/server/mydb.php');
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Írd be az email címed";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Írd be a jelszavad";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM tm_users WHERE email = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include 'components/head.php';?>
        <title>Mixby | belépés </title>
    </head>
    <body>
        <div class="content-wrapper row m-0">
            <div class="col-lg-8 nodisplay p-0">
                    <img src="images/dashboard.png" alt="dashboard" width="100%">
            </div>
            <div class="col-lg-4 bg-dark">
                    <div class="d-flex flex-column justify-content-center side">
                        <div class="px-5">
                            <h4 class="text-light">Üdvözlünk a Mixby-n! 🚀</h4>
                            <div class="form-text">Jelentkezz be, hogy kezdetét vegye a trónfosztás 👑</div>
                            <div class="alert alert-primary mt-4" role="alert">
                                Ha bármi hibát észlelsz, vedd fel a kapcsolatot az ügyfélszolgálattal<br>
                              </div>
                        </div>
                        <div class="d-flex justify-content-center">
                        <form class="w-100 px-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email cím</label>
                              <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                              <span class="invalid-feedback"><?php echo $email_err; ?></span>
                              <div id="emailHelp" class="form-text">Senkivel nem osztjuk meg személyes adataid.</div>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Jelszó</label>
                              <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                              <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Emlékezz rám</label>
                            </div>
                            <button type="submit" name="login_user" class="btn btn-primary w-100">Bejelentkezés</button>
                        </form>
                    </div>
                    <hr class="">
                    <div class="d-flex justify-content-end px-5">
                        <span class="me-2">Űj vagy a platformon?</span><a href="register.php">Regisztráció</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>