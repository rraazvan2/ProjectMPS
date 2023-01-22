<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header('Location: ../profile.php');

    exit;

}

include_once "../../../assets/inc/db.php";

if ($usertype < '3'){

    header('Location: ../profile.php');

    exit;

}

?>

<!DOCTYPE HTML>

<html>

	<head>

		<title>Managementul Proiectelor Software</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="stylesheet" href="../../../assets/css/main.css" />



    <script>

        $(document).ready(function(){

            $('[data-toggle="tooltip"]').tooltip();   

        });

    </script>

</head>



<body>

<body class="subpage">

		<!-- Header -->

		<header id="header">

			<div class="logo">

				<a href="../profile.php">Managementul

					<span> Proiecetelor Software</span>

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



											<h2>CRUD<br><a href="create.php"><button type="submit" name="cautare">Create</button></a></h2>



<div>



	<p>Your account details are below:</p>



	<table>





    <div class="wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="mt-5 mb-3 clearfix">

                    </div>

                    <?php

                    // Include config file

                    require_once "../../../assets/inc/db.php";

                        echo "<h2>Tabel of data record</h2>";

                    // Attempt select query execution

                    $sql = "SELECT * FROM ESPtable2";

                    if($result = mysqli_query($link, $sql)){

                        if(mysqli_num_rows($result) > 0){

                            echo '<table class="table table-bordered table-striped">';

                                echo "<thead>";

                                    echo "<tr>";

                                        echo "<th>ID</th>";

                                        echo "<th>Arduino ID</th>";

                                        echo "<th>Cladirea</th>";

                                        echo "<th>Email</th>";

                                        echo "<th>CRUD</th>";

                                    echo "</tr>";

                                echo "</thead>";

                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){

                                    echo "<tr>";



                                        echo "<td>" . $row['id'] . "</td>";

                                        echo "<td>" . $row['id_arduino'] . "</td>";

                                        echo "<td>" . $row['NUME_CLADIRE'] . "</td>";

                                        echo "<td>" . $row['email'] . "</td>";

                                    echo "<td>";

                                    echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

                                    echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';

                                    echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';

                                    echo "</td>";

                                    echo "</tr>";

                                }

                                echo "</tbody>";                            

                            echo "</table>";

                            // Free result set

                            mysqli_free_result($result);

                        } else{

                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';

                        }

                    } else{

                        echo "Oops! Something went wrong. Please try again later.";

                    }
                    // Close connection

                    mysqli_close($link);

                    ?>

                </div>

            </div>        

        </div>

    </div>

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

					&copy; Managementul Proiecetelor Software. All rights reserved.

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