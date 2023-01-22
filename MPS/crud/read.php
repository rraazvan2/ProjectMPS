<?php
// Check existence of id parameter before processing further
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../login.html");
    exit();
}
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "../../../assets/inc/db.php";

    // Prepare a select statement
    $sql = "SELECT * FROM ESPtable2 WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                 contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $id = $row["id"];
                $id_arduino = $row["id_arduino"];
                $PASSWORD = $row["PASSWORD"];
                $NUME_CLADIRE = $row["NUME_CLADIRE"];
                $email = $row["email"];
                $SENZOR_1 = $row["SENZOR_1"];
                $DESCRIERE_1 = $row["DESCRIERE_1"];
                $SENZOR_2 = $row["SENZOR_2"];
                $DESCRIERE_2 = $row["DESCRIERE_2"];
                $SENZOR_3 = $row["SENZOR_3"];
                $DESCRIERE_3 = $row["DESCRIERE_3"];
                $SENZOR_4 = $row["SENZOR_4"];
                $DESCRIERE_4 = $row["DESCRIERE_4"];
                $SENZOR_5 = $row["SENZOR_5"];
                $DESCRIERE_5 = $row["DESCRIERE_5"];
                $SENZOR_6 = $row["SENZOR_6"];
                $DESCRIERE_6 = $row["DESCRIERE_6"];
                $SENZOR_7 = $row["SENZOR_7"];
                $DESCRIERE_7 = $row["DESCRIERE_7"];
                $SENZOR_8 = $row["SENZOR_8"];
                $DESCRIERE_8 = $row["DESCRIERE_8"];
                $SENZOR_9 = $row["SENZOR_9"];
                $DESCRIERE_10 = $row["DESCRIERE_10"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Managementul Proiectelor Software</title>
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
            <a href="../../index.php">Acasa</a>
        </li>

        <?php if (
            isset($_SESSION["loggedin"]) &&
            $_SESSION["loggedin"] == true
        ) {
            echo '<li><a href="../logout.php">Logout</a></li>
								  <li><a href="../profile.php">Profil</a></li>';
        } else {
            echo '<li><a href="../login.html">Login</a></li>';
        } ?>
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
                            <h1 class="mt-5 mb-3">View Record Accounts</h1>
                            <div class="form-group">
                                <label>ID</label>
                                <p><b><?php echo $row["id"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Arduino ID</label>
                                <p><b><?php echo $row["id_arduino"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>PASSWORD</label>
                                <p><b><?php echo $row["PASSWORD"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Cladirea</label>
                                <p><b><?php echo $row[
                                        "NUME_CLADIRE"
                                        ]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <p><b><?php echo $row["email"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 1</label>
                                <p><b><?php echo $row["SENZOR_1"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 1</label>
                                <p><b><?php echo $row["DESCRIERE_1"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 2</label>
                                <p><b><?php echo $row["SENZOR_2"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 2</label>
                                <p><b><?php echo $row["DESCRIERE_2"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 3</label>
                                <p><b><?php echo $row["SENZOR_3"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 3</label>
                                <p><b><?php echo $row["DESCRIERE_3"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 4</label>
                                <p><b><?php echo $row["SENZOR_4"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 4</label>
                                <p><b><?php echo $row["DESCRIERE_4"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 5</label>
                                <p><b><?php echo $row["SENZOR_5"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 5</label>
                                <p><b><?php echo $row["DESCRIERE_5"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 6</label>
                                <p><b><?php echo $row["SENZOR_6"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 6</label>
                                <p><b><?php echo $row["DESCRIERE_6"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 7</label>
                                <p><b><?php echo $row["SENZOR_7"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 7</label>
                                <p><b><?php echo $row["DESCRIERE_7"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 8</label>
                                <p><b><?php echo $row["SENZOR_8"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 8</label>
                                <p><b><?php echo $row["DESCRIERE_8"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 9</label>
                                <p><b><?php echo $row["SENZOR_9"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 9</label>
                                <p><b><?php echo $row["DESCRIERE_9"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>Senzor 10</label>
                                <p><b><?php echo $row["SENZOR_10"]; ?></b></p>
                            </div>

                            <div class="form-group">
                                <label>DESCRIEREA PENTRU SENZOR 10</label>
                                <p><b><?php echo $row[
                                        "DESCRIERE_10"
                                        ]; ?></b></p>
                            </div>

                            <a href="admin.php"><button>Back</button></a>
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