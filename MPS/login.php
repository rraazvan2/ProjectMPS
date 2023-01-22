<?php

ob_start();

session_start();

include_once ('../../assets/inc/db.php');

?>

<html>

<head>

    <title>Managementul Proiectelor Software</title>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="../../assets/css/main.css" />

</head>

<body class="subpage">

<!-- Header -->

<header id="header">

    <div class="logo">

        <a href="profile.php">Managementul

            <span> Proiectelor Software</span>

        </a>

    </div>

    <a href="#menu">Meniu</a>

</header>

<!-- Nav -->

<nav id="menu">

    <ul class="links">

        <li>

            <a href="../index.php">Acasa</a>

        </li>

        <?php

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            echo '<li><a href="logout.php">Logout</a></li>

								  <li><a href="profile.php">Profil</a></li>';

        } else {

            echo '<li><a href="login.html">Login</a></li>';

        }

        ?>

    </ul>

</nav>

<!-- One -->

<section id="One" class="wrapper style3">

    <div class="inner">

        <header class="align-center">

            <p>Managementul Proiectelor Software</p>

            <h2>KXK</h2>

        </header>

    </div>

</section>

<div class="align-center">

    <?php

    if ( mysqli_connect_errno() ) {

        // If there is an error with the connection, stop the script and display the error.

        exit('Failed to connect to MySQL: ' . mysqli_connect_error());

    }

    // Now we check if the data from the login form was submitted, isset() will check if the data exists.

    if ( !isset($_POST['username'], $_POST['password']) ) {

        // Could not get the data that should have been sent.

        exit('Please fill both the username and password fields!');

    }

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.

    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

        $stmt->bind_param('s', $_POST['username']);

        $stmt->execute();

        // Store the result so we can check if the account exists in the database.

        $stmt->store_result();



        if ($stmt->num_rows > 0) {

            $stmt->bind_result($id, $password);

            $stmt->fetch();

            // Account exists, now we verify the password.

            // Note: remember to use password_hash in your registration file to store the hashed passwords.

            if (password_verify($_POST['password'], $password)) {

                // Verification success! User has logged-in!

                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.

                session_regenerate_id();

                $_SESSION['loggedin'] = TRUE;

                $_SESSION['name'] = $_POST['username'];

                $_SESSION['id'] = $id;

                $_SESSION['phone'] = $phone;

                header('Location: profile.php'); // redirect afeter login is ok

            } else {

                // Incorrect password

                echo 'Numele sau parola nu sunt corecte(poate chiar ambele)!';

            }

        } else {

            // Incorrect username

            echo 'Numele sau parola nu sunt corecte(poate chiar ambele)!';

        }



        $stmt->close();

    }

    ?>

</div>

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

<script src="../../assets/js/jquery.min.js"></script>

<script src="../../assets/js/jquery.scrollex.min.js"></script>

<script src="../../assets/js/skel.min.js"></script>

<script src="../../assets/js/util.js"></script>

<script src="../../assets/js/main.js"></script>

</body>

</html>

