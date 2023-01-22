<?php
session_start();
require "../../assets/inc/db.php";
$email = "";
$name = "";
$errors = array();
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM accounts WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $update_otp = "UPDATE accounts SET code = $code, WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: profile.php');
                exit();
            }else{
                $errors['otp-error'] = "Nu a reusit producerea codului";
            }
        }else{
            $errors['otp-error'] = "Ati introdus un cod gresit";
        }
    }
    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM accounts WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE accounts SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Codul pentru resetarea parolei";
                $message = '<p>Buna ziua,'.'<br>'.$nume.' '.$prenume.'</p><br>'.'Codul pentru resetarea parolei este: '.$code.'<br>'.'Va rugam sa aveti mare grija cu parola dumneavoastra!'.'<br>'.'O zi buna,'.'<br>'.'Amintiridecalitate';
                $from    = 'amintiridecalitate@amintiridecalitate.ro';
                $sender = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Am trimis un cod pentru resetarea parolei pe - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: code-forgot-password.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Nu s-a putut trimite codul! va rugam sa luati legatura cu un administrator";
                }
            }else{
                $errors['db-error'] = "Nu s-a putut trimite codul! va rugam sa luati legatura cu un administrator";
            }
        }else{
            $errors['email'] = "Aceasta adresa de email nu exista";
        }
    }
        //if user click check reset otp button
        if(isset($_POST['check-reset-otp'])){
            $_SESSION['info'] = "";
            $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
            $check_code = "SELECT * FROM accounts WHERE code = $otp_code";
            $code_res = mysqli_query($con, $check_code);
            if(mysqli_num_rows($code_res) > 0){
                $fetch_data = mysqli_fetch_assoc($code_res);
                $email = $fetch_data['email'];
                $_SESSION['email'] = $email;
                $info = "Va rugam pentru crearea unei noi parole sa nu folositi alt site!";
                $_SESSION['info'] = $info;
                header('location: reset-password.php');
                exit();
            }else{
                $errors['otp-error'] = "Codul introdus este gresit";
            }
        }
            //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Ai introdus 2 parole diferite!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE accounts SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Parola a fost schimbata cu succes, acum va puteti poti".header('../pages/login.html');;
                $_SESSION['info'] = $info;
            }else{
                $errors['db-error'] = "Nu s-a putut schimba parola, va rugam sa luati legatura cu un administrator";
            }
        }
    }
?>