<?php
session_start();
// error_reporting(0);

if(count($_SESSION)){
    $success_message = @$_SESSION["success_message"];
    $message = @$_SESSION["message"];
}
unset($_SESSION['message']);
unset($_SESSION['success_message']);


require_once 'app/db/connection.php';

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $connection->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'")->fetch_assoc();
    if(!$result){
        $message = "Email and/or Password is incorrect";
    } else {
        unset($_POST);
        $_SESSION['email'] = $email;
        $_SESSION['log'] = true;
        header("Location: dashboard.php");
    }
    print_r($result);
    unset($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/styles/global.css">
    <link rel="stylesheet" href="public/styles/login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="content-top">
            <p>LOGIN</p>
        </div>
        <div class="content-bottom">
            <form action="index" method="POST">
                <input type="text" name="email" placeholder="Email" class="input-text input" autocomplete="off"
                    autofocus required>
                <input type="password" name="password" placeholder="Password" class="input-text input" autocomplete="off"
                    autofocus required minlength="8">
                <div class="submit-button">
                    <div>
                        <input type="submit" name="submit" value="GO">
                        <p> ></p>
                    </div>

                </div>
            </form>


        </div>
    </div>
    <div class="message">
        <?php 
            if(@$message){
                echo "<p>$message</p>";
            } else if(@$success_message){
                echo "<p green>$success_message</p>";
            }
        ?>
    </div>

    <div class="other-button">
        <a href="register">REGISTER</a>
    </div>
</body>

</html>