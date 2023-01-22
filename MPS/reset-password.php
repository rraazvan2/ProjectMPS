<?php require_once "forgot-password.php"; ?>
<?php
$email = $_SESSION['email'];
if($email == false){
  header('../../login.html');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Managementul Proiectelor Software</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
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
						<h2>Create a New password</h2>
					</header>
				</div>
			</section>
			<!-- Two -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<header class="align-center">
								<p>Managementul Proiectelor Software</p>
								<div class="login">
									<h2>New password</h2>
									<form action="reset-password.php" method="POST" autocomplete="off">
                                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
										<label for="password">
											<i class="fas fa-password"></i>
										</label>
										<input type="password" name="password" placeholder="Create New password" id="password" required width="20px">
                                        <label for="password">
											<i class="fas fa-password"></i>
										</label>
										<input type="password" name="cpassword" placeholder="Confirm New Password" id="cpassword" required width="20px">
												<br>
													<input type="submit" name="change-password" value="Change">
														<br>
															<br>
																<br>
																	<div class="copyright">
                                &copy; Managementul Proiectelor Software. All rights reserved.
                                </div>
																</form>
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