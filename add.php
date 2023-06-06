<?php
session_start();
if (count($_SESSION)) {
    $success_message = @$_SESSION["success_message"];
    $message = @$_SESSION["message"];
}

require_once 'app/db/connection.php';


if (!@$_SESSION['email'] && !@$_SESSION['log'] && !@$_SESSION) {
    $_SESSION["message"] = "Please Log In First!";
    header("Location: index");
}

if (isset($_POST['submit'])) {
    $emailNotFound = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $emailNotFound->bind_param("s", $email);

    

    $email = $_SESSION["email"];
    $emailNotFound->execute();
    $emailNotFound = $emailNotFound->get_result();

    $subscriptionType = $_POST["subscription_type"];
    $from = $_POST["from"];
    $until = $_POST["until"];
    $price = $_POST["price"];
    $paymentType = $_POST["payment_type"];
   

    
    if (!$emailNotFound) {
        $_SESSION["subscription_type"] = $subscriptionType;
        $_SESSION["from"] = $from;
        $_SESSION["until"] = $until;
        $_SESSION["price"] = $price;
        $_SESSION["paymentType"] = $paymentType;
        unset($_POST);
        $_SESSION["message"] = "Email is not registered!";
    } else {
        unset($_SESSION["message"]);

        $input = $connection->prepare("INSERT INTO subscriptions (email, subscription_type, `from`, `until`, price, payment_type) VALUES (?, ?, ?, ?, ?, ?)");
        $input->bind_param("ssssss", $email, $subscriptionType, $from, $until, $price, $paymentType);
        $input->execute();
        $result = $input->get_result();

        header("Location: subscriptions");
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
    <div class="container" style="height: auto;">
        <div class="content-top">
            <p>+ DATA</p>
        </div>
        <div class="content-bottom">
            <form action="add" method="POST">
                <input type="email" name="email" placeholder="Email" class="input-text input" autocomplete="off"
                    autofocus required>
                <input type="text" name="subscription_type" placeholder="Subscription Type" class="input-text input"
                    autocomplete="off" autofocus required value="<?= @$_SESSION["subscription_type"] ?>">
                <input type="date" name="from" placeholder="Password" class="input-text input" autocomplete="off"
                    autofocusvalue="<?= @$_SESSION['from']; ?>" required>
                <input type="date" name="until" placeholder="Password" class="input-text input" autocomplete="off"
                    autofocus value="<?= @$_SESSION['until']; ?>" required>
                <input type="text" name="price" placeholder="Price" class="input-text input" autocomplete="off"
                    autofocus value="<?= @$_SESSION['price']; ?>" required>
                <input type="text" name="payment_type" placeholder="Payment Type" class="input-text input"
                    autocomplete="off" autofocus value="<?= @$_SESSION['payment_type']; ?>" required>
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
        if (@$message) {
            echo "<p>$message</p>";
        } else if (@$success_message) {
            echo "<p green>$success_message</p>";
        }

        $email = $_SESSION['email'];
        $log = $_SESSION['log'];
        session_unset();
        $_SESSION['email'] = $email;
        $_SESSION['log'] = $log;
        ?>
    </div>


</body>

</html>