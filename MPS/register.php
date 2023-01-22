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
			</ul>
		</nav>
		<!-- One -->
		<section id="One" class="wrapper style3">
			<div class="inner">
				<header class="align-center">
					<p>Managementul Proiectelor Software</p>
					<h2>Inregistrare</h2>
				</header>
			</div>
		</section>
<div class="align-center">
<?php
// Change this to your connection info.
session_start();
include_once ('../../assets/inc/db.php');
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	echo '<br>';echo '<br>';
	echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
	echo '<br>';echo '<br>';
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['phone'], $_POST['nume'], $_POST['prenume'], $_POST['cpassword'])) {
	// Could not get the data that should have been sent.
	echo '<br>';echo '<br>';
	echo 'Te rog sa completezi tot formularul';
	echo '<br>';echo '<br>';
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['nume']) || empty($_POST['prenume']) || empty($_POST['cpassword'])) {
	// One or more values are empty.
	echo '<br>';echo '<br>';
	echo 'Te rog sa completezi tot formularul';
	echo '<br>';echo '<br>';
}

if (strlen($_POST['phone'] < 10) || strlen($_POST['phone']) > 13){
	echo '<br>';echo '<br>';
	echo 'Nr de telefon nu este valid';
	echo '<br>';echo '<br>';
	echo 'Trebuie sa contina minim 10 caractere';
	echo '<br>';echo '<br>';
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	echo '<br>';echo '<br>';
	echo 'Email-ul nu este valid';
	echo '<br>';echo '<br>';
}

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    echo '<br>';echo '<br>';
	echo 'Username-ul nu este valid';
	echo '<br>';echo '<br>';
}

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	echo '<br>';echo '<br>';
	echo 'Parola trebuie sa fie de minim 5 caractere si maxim 20';
	echo '<br>';echo '<br>';
}

if (strlen($_POST['cpassword']) > 20 || strlen($_POST['cpassword']) < 5) {
	echo '<br>';echo '<br>';
	echo 'Parola trebuie sa fie de minim 5 caractere si maxim 20';
	echo '<br>';echo '<br>';
}

if($_POST['cpassword'] !== $_POST['password']){
	echo '<br>';echo '<br>';
	echo "Ai introdus 2 parole diferite!";
	echo '<br>';echo '<br>';
} else {

$email = mysqli_real_escape_string($con, $_POST['email']);
$email_check = "SELECT * FROM accounts WHERE email LIKE '$email'";
$res = mysqli_query($con, $email_check);
if(mysqli_num_rows($res) > 0 ){
	echo '<br>';echo '<br>';
	echo 'Exista deja un cont cu acest email!';
	echo '<br>';echo '<br>';
	echo "Te rog sa folosesti alta adresa de email!";
	echo '<br>';echo '<br>';
} else {
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password, phone, nume, prenume FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo '<br>';echo '<br>';
		echo 'Username-ul este luat, te rog sa folosesti altul';
		echo '<br>';echo '<br>';
	} else {
		// Username doesnt exists, insert new account
        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code, phone, nume, prenume) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$uniqid = uniqid();
    $stmt->bind_param('sssssss', $_POST['username'], $password, $_POST['email'], $uniqid, $_POST['phone'], $_POST['nume'], $_POST['prenume']);
	$stmt->execute();
	$from    = 'amintiridecalitate@amintiridecalitate.ro';
    $subject = 'Activare cont';
    $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
    // Update the activation variable below
    $activate_link = 'https://www.amintiridecalitate.ro/pages/MPS/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
    $message = '<p>Buna ziua,'.'<br>'.$_POST['nume'].' '.$_POST['prenume'].'<br>'.'Va multumim ca ne-ati ales pe voi'.'<br>'.'<p>Va rugam sa dati click pe urmatorul link pentru a activa contul: <a href="' . $activate_link . '">' . $activate_link . '</a></p>'.'<br>'.'Datele dumneavoastra de conectare sunt urmatoarele:'.'<br>'.'<br>'.'Username-ul: '.$_POST['username'].'<br>'.'Password: '.$_POST['password'].'<br>'.'<br>'.'Informatii suplimentare:'.'<br>'.'Email: '.$_POST['email'].'<br>'.'Nr de telefon: '.$_POST['phone'].'<br>'."O zi buna,".'<br>'."Amintiridecalitate";
    mail($_POST['email'], $subject, $message, $headers);
	echo '<br>';echo '<br>';
    echo 'Te rog sa verifici email-ul pentru activarea contului!'.'<br>'.'Inapoi la <a href="../index.html">login</a>!';
	echo '<br>';echo '<br>';
	
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo '<br>';echo '<br>';
	echo 'Could not prepare statement!';
	echo '<br>';echo '<br>';
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo '<br>';echo '<br>';
	echo 'Could not prepare statement!';
	echo '<br>';echo '<br>';
}
}
}
$con->close();
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
