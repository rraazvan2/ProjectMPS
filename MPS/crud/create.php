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
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate Arduino ID
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
    $sql = "INSERT INTO ESPtable2 (id_arduino, PASSWORD, NUME_CLADIRE, email, DESCRIERE_1, DESCRIERE_2, DESCRIERE_3, DESCRIERE_4, DESCRIERE_5, DESCRIERE_6, DESCRIERE_7, DESCRIERE_8, DESCRIERE_9, DESCRIERE_10) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $param_id_arduino, $param_PASSWORD, $param_NUME_CLADIRE, $param_email, $param_DESCRIERE_1, $param_DESCRIERE_2, $param_DESCRIERE_3, $param_DESCRIERE_4, $param_DESCRIERE_5, $param_DESCRIERE_6, $param_DESCRIERE_7, $param_DESCRIERE_8, $param_DESCRIERE_9, $param_DESCRIERE_10);

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

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records created successfully. Redirect to landing page
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

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Accounts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Create accounts</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>