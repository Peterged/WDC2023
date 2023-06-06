<?php
session_start();

unset($_SESSION['message']);
unset($_SESSION['success_message']);

require 'app/db/connection.php';

if (!@$_SESSION['email'] && !@$_SESSION['log'] && !@$_SESSION) {
    $_SESSION["message"] = "Please Log In First!";
    header("Location: index");
}

// ---------------------------------------------


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/styles/global.css">
    <link rel="stylesheet" href="public/styles/sidebar.css">
    <link rel="stylesheet" href="public/styles/dashboard.css">
    <script src="public/javascript/global.js" type="text/javascript" defer></script>
    <script src="public/javascript/home.js" type="text/javascript" defer></script>
    <title>Admin Panel - Home</title>
</head>

<body>
    <div class="box-container">
        <div class="content sidebar">
            <div class="logo">
                <p class="sidebar-responsive-toggler"><</p>
                <p class="logo-title">Admin</p>
                <p class="sidebar-toggler">></p>
            </div>

            <span class="line white"></span>
            <div class="buttons">
                <a href="dashboard">DASHBOARD
                    <img href="" src="public/icons/dashboard.svg" alt="">
                </a>
                <a href="#">USERS
                    <img href="#" src="public/icons/users.svg" alt="">
                </a>
                <a href="subscriptions">SUBSCRIPTIONS
                    <img href="subscriptions" src="public/icons/subscription.svg" alt="">
                </a>
            </div>

            <span class="line white m-t-auto"></span>
            <div class="buttons">
                <a href="#">PROFILE
                    <img href="#" src="public/icons/profile.svg" alt="">
                </a>
                <a href="#">LOG OUT
                    <img href="logout.php" src="public/icons/settings.svg" alt="">
                </a>
            </div>
        </div>
        <div class="content main">
            
        </div>
    </div>

    <div class="addData-popup popup">
            <form action="" method="post">

            </form>
        </div>
</body>

</html>