<!DOCTYPE HTML>
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
					<a href="profile.php">Acasa</a>
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
					<h2>Activare cont</h2>
				</header>
			</div>
		</section>
<div class="align-center">
<?php
// Change this to your connection info.
session_start();
include_once "../../assets/inc/db.php";
// Try and connect using the info above.
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	echo '<br>';
	echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
	echo '<br>';
}
// First we check if the email and code exists...
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			// Account exists with the requested email and code.
			if ($stmt = $con->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
				// Set the new activation code to 'activated', this is how we can check if the user has activated their account.
				$newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();
				echo '<br>';
				echo '<br>';
				echo 'Contul tau este activat! Acum poti sa te <a href="login.html">loghezi</a>!';
				echo '<br>';
				echo '<br>';
			}
		} else {
			echo '<br>';echo '<br>';
			echo 'Contul acesta a fost deja activat sau nu exista!';
			echo '<br>';echo '<br>';
		}
	}
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
