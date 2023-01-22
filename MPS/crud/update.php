<?php
// Include config file
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header('Location: ../login.html');
    exit;
}
require_once "../../../assets/inc/db.php";
// Define variables and initialize with empty values
$id_arduino = $PASSWORD = $email = $NUME_CLADIRE = $DESCRIERE_1 = $DESCRIERE_2 = $DESCRIERE_3 = $DESCRIERE_4 = $DESCRIERE_5 = $DESCRIERE_6 = $DESCRIERE_7 = $DESCRIERE_8 = $DESCRIERE_9 = $DESCRIERE_10 = "";
$id_arduino_err = $PASSWORD_err = $NUME_CLADIRE_err = $email_err = $DESCRIERE_1_err = $DESCRIERE_2_err = $DESCRIERE_3_err = $DESCRIERE_4_err = $DESCRIERE_5_err = $DESCRIERE_6_err = $DESCRIERE_7_err = $DESCRIERE_8_err = $DESCRIERE_9_err = $DESCRIERE_10_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name   
    $input_id_arduino = trim($_POST["id_arduino"]);
        if(empty($input_id_arduino)){
            $id_arduino_err = "Please enter an username.";
        } else {
            $id_arduino = $input_id_arduino;
        }
    
            // Validate password
            $input_PASSWORD = trim($_POST["PASSWORD"]);
            if(empty($input_PASSWORD)){
                $PASSWORD_err = "Please enter an password.";
            } else {
                $PASSWORD = $input_PASSWORD;
            }

    $input_NUME_CLADIRE = trim($_POST["NUME_CLADIRE"]);
    if(empty($input_NUME_CLADIRE)){
        $NUME_CLADIRE_err = "Please enter an username.";
    } else {
        $NUME_CLADIRE = $input_NUME_CLADIRE;
    }
    
            // Validate email
                $input_email = trim($_POST["email"]);
                if(empty($input_email)){
                    $email_err = "Please enter an email."; 
                } else {
                    $email = $input_email;
                }

    // Validate Descriere senzor 1
    $input_DESCRIERE_1 = trim($_POST["DESCRIERE_1"]);
    if(empty($input_DESCRIERE_1)){
        $DESCRIERE_1_err = "Please enter an description";
    } else{
        $DESCRIERE_1 = $input_DESCRIERE_1;
    }

    // Validate Descriere senzor 2
    $input_DESCRIERE_2 = trim($_POST["DESCRIERE_2"]);
    if(empty($input_DESCRIERE_2)){
        $DESCRIERE_2_err = "Please enter an description";
    } else{
        $DESCRIERE_2 = $input_DESCRIERE_2;
    }

    // Validate Descriere senzor 3
    $input_DESCRIERE_3 = trim($_POST["DESCRIERE_3"]);
    if(empty($input_DESCRIERE_3)){
        $DESCRIERE_3_err = "Please enter an description";
    } else{
        $DESCRIERE_3 = $input_DESCRIERE_3;
    }

    // Validate Descriere senzor 4
    $input_DESCRIERE_4 = trim($_POST["DESCRIERE_4"]);
    if(empty($input_DESCRIERE_4)){
        $DESCRIERE_4_err = "Please enter an description";
    } else{
        $DESCRIERE_4 = $input_DESCRIERE_4;
    }

    // Validate Descriere senzor 5
    $input_DESCRIERE_5 = trim($_POST["DESCRIERE_5"]);
    if(empty($input_DESCRIERE_1)){
        $DESCRIERE_5_err = "Please enter an description";
    } else{
        $DESCRIERE_5 = $input_DESCRIERE_5;
    }

    // Validate Descriere senzor 6
    $input_DESCRIERE_6 = trim($_POST["DESCRIERE_6"]);
    if(empty($input_DESCRIERE_6)){
        $DESCRIERE_6_err = "Please enter an description";
    } else{
        $DESCRIERE_6 = $input_DESCRIERE_6;
    }

    // Validate Descriere senzor 7
    $input_DESCRIERE_7 = trim($_POST["DESCRIERE_7"]);
    if(empty($input_DESCRIERE_7)){
        $DESCRIERE_7_err = "Please enter an description";
    } else{
        $DESCRIERE_7 = $input_DESCRIERE_7;
    }

    // Validate Descriere senzor 8
    $input_DESCRIERE_8 = trim($_POST["DESCRIERE_8"]);
    if(empty($input_DESCRIERE_8)){
        $DESCRIERE_8_err = "Please enter an description";
    } else{
        $DESCRIERE_8 = $input_DESCRIERE_8;
    }

    // Validate Descriere senzor 9
    $input_DESCRIERE_9 = trim($_POST["DESCRIERE_9"]);
    if(empty($input_DESCRIERE_1)){
        $DESCRIERE_9_err = "Please enter an description";
    } else{
        $DESCRIERE_9 = $input_DESCRIERE_9;
    }

    // Validate Descriere senzor 10
    $input_DESCRIERE_10 = trim($_POST["DESCRIERE_10"]);
    if(empty($input_DESCRIERE_10)){
        $DESCRIERE_10_err = "Please enter an description";
    } else{
        $DESCRIERE_10 = $input_DESCRIERE_10;
    }

    
    // Check input errors before inserting in database
    if(empty($id_arduino_err) && empty($PASSWORD_err) && empty($email_err) && empty($DESCRIERE_1_err) && empty($DESCRIERE_2_err) && empty($DESCRIERE_3_err) && empty($DESCRIERE_4_err) && empty($DESCRIERE_5_err) && empty($DESCRIERE_6_err) && empty($DESCRIERE_7_err) && empty($DESCRIERE_8_err) && empty($DESCRIERE_9_err) && empty($DESCRIERE_10_err)){
        // Prepare an insert statement
        $sql = "UPDATE ESPtable2 SET id_arduino=?, PASSWORD=?, NUME_CLADIRE=?, email=?, DESCRIERE_1=?, DESCRIERE_2=?, DESCRIERE_3=?, DESCRIERE_4=?, DESCRIERE_5=?, DESCRIERE_6=?, DESCRIERE_7=?, DESCRIERE_8=?, DESCRIERE_9=?, DESCRIERE_10=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "ssssssssssssssi", $param_id_arduino, $param_PASSWORD, $param_NUME_CLADIRE, $param_email, $param_DESCRIERE_1, $param_DESCRIERE_2, $param_DESCRIERE_3, $param_DESCRIERE_4, $param_DESCRIERE_5, $param_DESCRIERE_6, $param_DESCRIERE_7, $param_DESCRIERE_8, $param_DESCRIERE_9, $param_DESCRIERE_10, $param_id);

            // Set parameters
            $param_id_arduino = $id_arduino;
            $param_PASSWORD = $PASSWORD;
            $param_NUME_CLADIRE = $NUME_CLADIRE;
            $param_email = $email;
            $param_DESCRIERE_1 = $DESCRIERE_1;
            $param_DESCRIERE_2 = $DESCRIERE_2;
            $param_DESCRIERE_3 = $DESCRIERE_3;
            $param_DESCRIERE_4 = $DESCRIERE_4;
            $param_DESCRIERE_5 = $DESCRIERE_5;
            $param_DESCRIERE_6 = $DESCRIERE_6;
            $param_DESCRIERE_7 = $DESCRIERE_7;
            $param_DESCRIERE_8 = $DESCRIERE_8;
            $param_DESCRIERE_9 = $DESCRIERE_9;
            $param_DESCRIERE_10 = $DESCRIERE_10;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: admin.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM ESPtable2 WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $id_arduino = $row["id_arduino"];
                    $PASSWORD = $row["PASSWORD"];
                    $NUME_CLADIRE = $row["NUME_CLADIRE"];
                    $email = $row["email"];
                    $DESCRIERE_1 = $row["DESCRIERE_1"];
                    $DESCRIERE_2 = $row["DESCRIERE_2"];
                    $DESCRIERE_3 = $row["DESCRIERE_3"];
                    $DESCRIERE_4 = $row["DESCRIERE_4"];
                    $DESCRIERE_5 = $row["DESCRIERE_5"];
                    $DESCRIERE_6 = $row["DESCRIERE_6"];
                    $DESCRIERE_7 = $row["DESCRIERE_7"];
                    $DESCRIERE_8 = $row["DESCRIERE_8"];
                    $DESCRIERE_9 = $row["DESCRIERE_9"];
                    $DESCRIERE_10 = $row["DESCRIERE_10"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<<!DOCTYPE HTML>
<html>
	<head>
		<title>Amintiri de calitate</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../../assets/css/main.css" />
	</head>
	<body class="subpage">
		<!-- Header -->
		<header id="header">
			<div class="logo">
				<a href="../profile.php">Managementul
					<span> Proiectelor Software</span>
				</a>
			</div>
			<a href="#menu">Meniu</a>
		</header>
		<!-- Nav -->
		<nav id="menu">
			<ul class="links">
				<li>
					<a href="../profile.php">Acasa</a>
				</li>

				<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
   						 	echo '<li><a href="../logout.php">Logout</a></li>
								  <li><a href="../profile.php">Profil</a></li>';
							} else {
   							 echo '<li><a href="../login.html">Login</a></li>';
							}
							?>
			</ul>
		</nav>
		<!-- One -->
		<section id="One" class="wrapper style3">
			<div class="inner">
				<header class="align-center">
					<p>Managementul Proiectelor Software</p>
					<h2>Admin</h2>
				</header>
			</div>
		</section>
		<!-- Two -->
		<section id="two" class="wrapper style2">
			<div class="inner">
				<div class="box">
					<div class="content">
						<header class="align-center">

											<h2>Admin</h2>

<div>

	<p>Your account details are below:</p>

	<table>
                    <h2 class="mt-5">Update Record Accounts</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label>Arduino ID</label>
                            <input type="text" name="id_arduino" class="form-control <?php echo (!empty($id_arduino)) ? 'is-invalid' : ''; ?>" value="<?php echo $id_arduino; ?>">
                            <span class="invalid-feedback"><?php echo $id_arduino_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>PASSWORD</label>
                            <input type="text" name="PASSWORD" class="form-control <?php echo (!empty($PASSWORD)) ? 'is-invalid' : ''; ?>" value="<?php echo $PASSWORD; ?>">
                            <span class="invalid-feedback"><?php echo $PASSWORD_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Numele cladiri</label>
                            <input type="text" name="NUME_CLADIRE" class="form-control <?php echo (!empty($NUME_CLADIRE)) ? 'is-invalid' : ''; ?>" value="<?php echo $NUME_CLADIRE; ?>">
                            <span class="invalid-feedback"><?php echo $NUME_CLADIRE_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 1</label>
                            <input type="text" name="DESCRIERE_1" class="form-control <?php echo (!empty($DESCRIERE_1)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_1; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_1_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 2</label>
                            <input type="text" name="DESCRIERE_2" class="form-control <?php echo (!empty($DESCRIERE_2)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_2; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_2_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 3</label>
                            <input type="text" name="DESCRIERE_3" class="form-control <?php echo (!empty($DESCRIERE_3)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_3; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_3_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 4</label>
                            <input type="text" name="DESCRIERE_4" class="form-control <?php echo (!empty($DESCRIERE_4)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_4; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_4_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 5</label>
                            <input type="text" name="DESCRIERE_5" class="form-control <?php echo (!empty($DESCRIERE_5)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_5; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_5_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 6</label>
                            <input type="text" name="DESCRIERE_6" class="form-control <?php echo (!empty($DESCRIERE_6)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_6; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_6_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 7</label>
                            <input type="text" name="DESCRIERE_7" class="form-control <?php echo (!empty($DESCRIERE_7)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_7; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_7_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 8</label>
                            <input type="text" name="DESCRIERE_8" class="form-control <?php echo (!empty($DESCRIERE_8)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_8; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_8_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 9</label>
                            <input type="text" name="DESCRIERE_9" class="form-control <?php echo (!empty($DESCRIERE_9)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_9; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_9_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>DESCRIEREA PENTRU SENZOR 10</label>
                            <input type="text" name="DESCRIERE_10" class="form-control <?php echo (!empty($DESCRIERE_10)) ? 'is-invalid' : ''; ?>" value="<?php echo $DESCRIERE_10; ?>">
                            <span class="invalid-feedback"><?php echo $DESCRIERE_10_err;?></span>
                        </div>


                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php"><button>Cancel</button></a>
                    </form>
    </table>

</div>

											</header>
						</div>
					</div>
				</div>
			</section>
			<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li>
							<a href="https://www.facebook.com/razvan.baloi.9/" class="icon fa-facebook">
								<span class="label">Facebook</span>
							</a>
						</li>
						<li>
							<a href="mailto:baloi.razvan.a9j@student.ucv.ro?Subject=Numele%20Dumnevoastra" class="icon fa-envelope-o">
								<span class="label">Email</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="copyright">
					&copy; Managementul Proiectelor Software. All rights reserved.
				</div>
			</footer>
			<!-- Scripts -->
			<script src="../../../assets/js/jquery.min.js"></script>
			<script src="../../../assets/js/jquery.scrollex.min.js"></script>
			<script src="../../../assets/js/skel.min.js"></script>
			<script src="../../../assets/js/util.js"></script>
			<script src="../../../assets/js/main.js"></script>
		</body>
	</html>