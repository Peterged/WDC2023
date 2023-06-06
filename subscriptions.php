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
$data = @$connection->query("SELECT * FROM subscriptions")->fetch_all(MYSQLI_ASSOC);


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
    <link rel="stylesheet" href="public/styles/table.css">
    <link rel="stylesheet" href="public/styles/subscription.css">
    <script src="public/javascript/global.js" type="text/javascript" defer></script>
    <script src="public/javascript/home.js" type="text/javascript" defer></script>
    <title>Admin Panel - Home</title>
</head>

<body>
    <div class="box-container">
        <div class="content sidebar">
            <div class="logo">
                <p class="sidebar-responsive-toggler">
                    <</p>
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
                <a href="#">SETTINGS
                    <img href="#" src="public/icons/settings.svg" alt="">
                </a>
            </div>
        </div>
        <div class="content main">
            <div class="add-row" href="add">
            <a href="add" class="add-data-button">ADD</a>
            </div>
            <div class="row1">

            </div>
            <div class="row2">

            </div>
            <div class="container">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">From</th>
                            <th scope="col">Until</th>
                            <th scope="col">Price</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php for ($i = 0; $i < count($data); $i++) { 
                        ?>
                        <tr>
                            <th scope="row">
                                <?= @$data[$i]['email'] ?>
                            </th>
                            <td data-title="ID">
                                <?= @$data[$i]['id'] ?>
                            </td>
                            <td data-title="Type">
                            <?= @$data[$i]['subscription_type'] ?>
                            </td>
                            <td data-title="From">
                            <?= @$data[$i]['from'] ?>
                            </td>
                            <td data-title="Until">
                            <?= @$data[$i]['until']  ?>
                            </td>
                            <td data-title="Price" data-type="currency">
                            <?= @$data[$i]['price'] ?>
                            </td>
                            <td data-title="Payment">
                            <?= @$data[$i]['payment_type'] ?>
                            </td>
                            <td data-title="Actions">
                                <a href="edit?id=<?= @$data[$i]['id'] ?>">EDIT</a>
                                <a href="delete?id=<?= @$data[$i]['id'] ?>">DELETE</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="table">
                <table class="table-data">
                    
                    
                </table>
            </div>
        </div>



    </div>

    <div class="addData-popup popup">
        <form action="" method="post">

        </form>
    </div>
</body>

</html>