<?php
session_start();
if(count($_SESSION)){
    $success_message = @$_SESSION["success_message"];
    $message = @$_SESSION["message"];
}
unset($_SESSION['message']);
unset($_SESSION['success_message']);
require_once 'app/db/connection.php';

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $doubleEmail = $connection->query("SELECT * FROM users WHERE email = '$email'");

    if($doubleEmail){
        $_SESSION['message'] = 'That email is taken!';
        unset($_POST);
        header("Location: register");
    }

    $result = $connection->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
    
    if($result){
        session_unset();
        $_SESSION["success_message"] = "Account Created!";
        header("Location: index");
    }
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
            <p>REGISTER</p>
        </div>
        <div class="content-bottom">
            <form action="register" method="POST">
                <input type="text" name="username" placeholder="Username" class="input-text input" autocomplete="off"
                    autofocus required minlength="3" title="Min 3 Characters!">
                <input type="text" name="email" placeholder="Email" class="input-text input" autocomplete="off"
                    autofocus required >
                <input type="password" name="password" placeholder="Password" class="input-text input" autocomplete="off"
                    autofocus required minlength="8" title="Min 8 Characters!">
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
        <a href="index">LOGIN</a>
    </div>
</body>

</html>