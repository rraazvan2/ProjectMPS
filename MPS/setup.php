<?php
if ($usertype < 2){
    session_start();
    session_destroy();
    header('Location: login.php');
}
?>