<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header('Location: login.php');
    exit;
}
include_once "../../assets/inc/db.php";
?>
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
				<a href="index.php">Managementul
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
					<h2>Profil</h2>
				</header>
			</div>
		</section>
		<!-- Two -->
		<section id="two" class="wrapper style2">
			<div class="inner">
				<div class="box">
					<div class="content">
						<header class="align-center">

											<h2>Bun venit <?php echo"$nume"." "."$prenume"; ?></h2>

<div>

	<p>Detalile contului:</p>

	<table>

		<?php
        
		if ($usertype > '1'){
			echo '<a href="../MPS/crud/admin.php"><button type="submit" name="cautare">Pagina de Admin</button></a>';
		}

		?>

		<tr>

			<td>Username:</td>

			<td><?=$_SESSION['name']?></td>

		</tr>
		<tr>

			<td>Nume:</td>

			<td><?=$nume?></td>

		</tr>
		<tr>

			<td>Prenume:</td>

			<td><?=$prenume?></td>

		</tr>
				<tr>

			<td>Nr telefon:</td>

			<td><?php 
			
			$String = $phone;
			
			$otherString = '*******';

			$substring = substr_replace($String, $otherString, 2,5);
			print $substring."<br>";
			?></td>

		</tr>


			<a href="spass.php"><button type="submit" name="cautare">Schimbare parola</button></a>
			<a href="pallmall.php"><button type="submit" name="cautare">Cautare</button></a>
		

		<?php
						if ($usertype > 1) {
   			echo '<td>Accestype: </td>'.'<td>'.$usertype.'</td>';
							}
							?>
		

		<tr>

			<td>Email:</td>

			<td><?=$email?></td>

		</tr>

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
			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/jquery.scrollex.min.js"></script>
			<script src="../../assets/js/skel.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>
		</body>
	</html>