<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header('Location: ../index.php');
    exit;
}
include_once "../../assets/inc/db.php";
include ('setup.php');


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

											<h2>Comenzi</h2>

<div>

	<p>Admin acces</p>
	<tr><td>Introduceti o valoare in cautare si selectati tipul dupa care dati enter</td></tr>
	<table>
	<form action="" method="post">
        <input type="text" placeholder="Search" name="search">
		<select name="selection">
			<option value="id">ALL</option>
			<option value="username">Username</option>
			<option value="email">Email</option>
			<option value="activated">Activated?</option>
			<option value="acces">TipAcces</option>
			<option value="telefon">Telefon</option>
			<option value="nume">Numele de familie</option>
			<option value="prenume">Prenumele</option>
		</select>
        <button type="submit" name="submit">Search</button>
    </form>
	<?php
if (isset($_POST['submit'])) {
    $searchValue = $_POST['search'];
    $con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ($con->connect_error) {
        echo "connection Failed: " . $con->connect_error;
    } else {
		if(isset($_POST['selection'])){
			$selection = $_POST['selection'];
			switch($selection){
				case 'id':
        $sql = "SELECT * FROM accounts WHERE id LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
			echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
		}
			break;
			
				case 'username':
					$sql = "SELECT * FROM accounts WHERE username LIKE '%$searchValue%'";

					$result = $con->query($sql);
					while ($row = $result->fetch_assoc()) {
						echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
					}
						break;
						

						case 'email' :
							$sql = "SELECT * FROM accounts WHERE email LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
			echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
		}
			break;
			

			case 'activated' :
				$sql = "SELECT * FROM accounts WHERE activation_code LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
			echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
		}
			break;
			

			case 'acces':
				$sql = "SELECT * FROM accounts WHERE usertype LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
			echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
			}
			break;

			case 'telefon':
				$sql = "SELECT * FROM accounts WHERE phone LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
			echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
			}
			break;

			case 'nume':
				$sql = "SELECT * FROM accounts WHERE nume LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
			echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
			}
			break;

			case 'prenume':
				$sql = "SELECT * FROM accounts WHERE prenume LIKE '%$searchValue%'";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
			echo "<tr><td></td></tr>";
			echo "<tr><td>Id cont: ".$row['id']."</td></tr>";
            echo "<tr><td>Username: ".$row['username']."</td></tr>";
            echo "<tr><td>Email:".$row['email'] . "</td></tr>";
			echo "<tr><td>Password:".$row['password']."</td></tr>";
			if($row['activation_code'] == 'activated'){
				echo'<tr><td>Contul Este Activat</td></tr>';}else{
					echo'<tr><td>Contul Nu este activat</td></tr>';
				}
			echo "<tr><td>Tipul de acces: ".$row['usertype']."</td></tr>";
			echo "<tr><td>"."Nr de telefon: ".$row['phone']."</td></tr>";
			echo "<tr><td>"."Nume: ".$row['nume']."</td></tr>";
			echo "<tr><td>"."Prenume: ".$row['prenume']."</td></tr>";
			echo "<br>";
			}
			break;
			
        
	}
	}
      
    }   
}
	?>
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
	