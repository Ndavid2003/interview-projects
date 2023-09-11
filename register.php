<?php
require_once('components/server/config.php');

//Regisztráció 
$username = $email = $password = '';
$username_err = $password_err = $email_err = "";
$balance = 0;
$goal = 50000;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Add meg a felhasználóneved";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "A felhasználóneved nem tartalmazhat speciális karaktereket";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tm_users WHERE username = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ez a felhasználónév már foglalt";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Hoppá! Hiba a rendszerben. :( ";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
  
    if(empty(trim($_POST["email"]))){
        $email_err = "Kérlek add meg az email címedet.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tm_users WHERE email = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Ez az email cím már foglalt.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Hoppá! Valami nem működik";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Kérlek add meg a  jelszavad";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A jelszónak minimum 6 karakter hosszúnak kell lennie";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO tm_users (username,email,password, balance, goal) VALUES (?,?,?, 0, 20000)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            
            // Set parameters
            $param_email = $email;
            $param_username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);// Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
    <?php include 'components/server/functions.php';?>
        <title>Mixby | regisztráció </title>
    </head>
    <body>
        <div class="content-wrapper row m-0">
            <div class="col-lg-8 p-0 nodisplay">
                    <img src="dashboard.png" alt="dashboard" width="100%">
            </div>
            <div class="col-lg-4 bg-dark">
                    <div class="d-flex flex-column justify-content-center side">
                        <div class="px-5">
                            <h4>Itt kezdődik a kaland! 🚀</h4>
                            <div class="form-text mb-2">Ilyen egyszerű még nem volt a pénzkeresés</div>
                        </div>
                        <div class="d-flex justify-content-center">
                        <form class="w-100 px-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Felhasználónév</label>
                                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                              </div>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email cím</label>
                              <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                              <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Jelszó</label>
                              <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                              <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                              <label class="form-check-label" for="exampleCheck1">Elfogadom a <a href="terms.php">Felhasználási feltételeket</a>
                                </label>
                            </div>
                            <button type="submit" name="reg_user" class="btn btn-primary w-100">Regisztráció</button>
                        </form>
                    </div>
                    <hr class="">
                    <div class="d-flex justify-content-end px-5">
                        <span class="me-2">Van már fiókod?</span><a href="login.php">Belépés</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>