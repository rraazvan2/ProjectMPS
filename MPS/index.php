<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header('Location: ../login.html');
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
                                    <option value="id_arduino">ID Arduino</option>
                                    <option value="NUME_CLADIRE">Numele cladiri</option>
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
                                                $sql = "SELECT * FROM ESPtable2 WHERE id LIKE '%$searchValue%'";

                                                $result = $con->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr><td></td></tr>";
                                                    echo "<tr><td>Id: ".$row['id']."</td></tr>";
                                                    echo "<tr><td>Arduino ID: ".$row['id_arduino']."</td></tr>";
                                                    echo "<tr><td>Arduino Password:".$row['PASSWORD']."</td></tr>";
                                                    echo "<tr><td>Numele cladiri:".$row['NUME_CLADIRE'] . "</td></tr>";
                                                    echo "<tr><td>Email:".$row['email']."</td></tr>";
                                                    if($row['SENZOR_1'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 1: ".$row['SENZOR_1']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_1']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_2'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 2: ".$row['SENZOR_2']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_2']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_3'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 3: ".$row['SENZOR_3']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_3']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_4'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 4: ".$row['SENZOR_4']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_4']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_5'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 5: ".$row['SENZOR_5']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_5']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_6'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 6: ".$row['SENZOR_6']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_6']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_7'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 7: ".$row['SENZOR_7']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_7']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_8'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 8: ".$row['SENZOR_8']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_8']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_9'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 9: ".$row['SENZOR_9']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_9']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_10'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 10: ".$row['SENZOR_10']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_10']."</td></tr>";
                                                    }
                                                    echo "<br>";
                                                }
                                                break;

                                            case 'id_arduino':
                                                $sql = "SELECT * FROM ESPtable2 WHERE id_arduino LIKE '%$searchValue%'";

                                                $result = $con->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr><td></td></tr>";
                                                    echo "<tr><td>Id: ".$row['id']."</td></tr>";
                                                    echo "<tr><td>Arduino ID: ".$row['id_arduino']."</td></tr>";
                                                    echo "<tr><td>Arduino Password:".$row['PASSWORD']."</td></tr>";
                                                    echo "<tr><td>Numele cladiri:".$row['NUME_CLADIRE'] . "</td></tr>";
                                                    echo "<tr><td>Email:".$row['email']."</td></tr>";
                                                    if($row['SENZOR_1'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 1: ".$row['SENZOR_1']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_1']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_2'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 2: ".$row['SENZOR_2']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_2']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_3'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 3: ".$row['SENZOR_3']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_3']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_4'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 4: ".$row['SENZOR_4']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_4']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_5'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 5: ".$row['SENZOR_5']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_5']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_6'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 6: ".$row['SENZOR_6']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_6']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_7'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 7: ".$row['SENZOR_7']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_7']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_8'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 8: ".$row['SENZOR_8']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_8']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_9'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 9: ".$row['SENZOR_9']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_9']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_10'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 10: ".$row['SENZOR_10']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_10']."</td></tr>";
                                                    }
                                                    echo "<br>";
                                                }
                                                break;


                                            case 'NUME_CLADIRE' :
                                                $sql = "SELECT * FROM ESPtable2 WHERE email LIKE '%$searchValue%'";

                                                $result = $con->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr><td></td></tr>";
                                                    echo "<tr><td>Id: ".$row['id']."</td></tr>";
                                                    echo "<tr><td>Arduino ID: ".$row['id_arduino']."</td></tr>";
                                                    echo "<tr><td>Arduino Password:".$row['PASSWORD']."</td></tr>";
                                                    echo "<tr><td>Numele cladiri:".$row['NUME_CLADIRE'] . "</td></tr>";
                                                    echo "<tr><td>Email:".$row['email']."</td></tr>";
                                                    if($row['SENZOR_1'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 1: ".$row['SENZOR_1']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_1']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_2'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 2: ".$row['SENZOR_2']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_2']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_3'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 3: ".$row['SENZOR_3']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_3']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_4'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 4: ".$row['SENZOR_4']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_4']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_5'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 5: ".$row['SENZOR_5']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_5']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_6'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 6: ".$row['SENZOR_6']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_6']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_7'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 7: ".$row['SENZOR_7']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_7']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_8'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 8: ".$row['SENZOR_8']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_8']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_9'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 9: ".$row['SENZOR_9']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_9']."</td></tr>";
                                                    }
                                                    if($row['SENZOR_10'] !== '255')
                                                    {
                                                        echo"<tr><td>SENZOR 10: ".$row['SENZOR_10']."</td></tr>";
                                                        echo"<tr><td>Descriere: ".$row['DESCRIERE_10']."</td></tr>";
                                                    }
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
