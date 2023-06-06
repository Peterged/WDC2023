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

$id = @$_GET['id'];

if(!$id){
    echo '<script>window.history.go(-1)</script>';
}
$data = $connection->prepare("SELECT * FROM subscriptions WHERE id = ?");
$data->bind_param("s", $id);
$data->execute();
$data = $data->get_result()->fetch_assoc();


if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    
    $emailNotFound = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $emailNotFound->bind_param("s", $email);
    $emailNotFound->execute();
    $emailNotFound = $emailNotFound->get_result()->fetch_assoc();

    

    
    $subscriptionType = $_POST["subscription_type"];
    $from = $_POST["from"];
    $until = $_POST["until"];
    $price = $_POST["price"];
    $paymentType = $_POST["payment_type"];



    if (!$emailNotFound['id']) {
        $_SESSION["subscription_type"] = $subscriptionType;
        $_SESSION["from"] = $from;
        $_SESSION["until"] = $until;
        $_SESSION["price"] = $price;
        $_SESSION["paymentType"] = $paymentType;
        unset($_POST);
        $_SESSION["message"] = "Email is not registered!";
    } else {
        unset($_SESSION["message"]);

        $input = $connection->prepare("UPDATE subscriptions SET email = ?, subscription_type = ?, `from` = ?, `until` = ?, price = ?, payment_type = ? WHERE id = ?");
        $input->bind_param("sssssss", $email, $subscriptionType, $from, $until, $price, $paymentType, $id);
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
            <p>EDIT</p>
        </div>
        <div class="content-bottom">
            <form action="edit?id=<?= $_GET['id'] ?>" method="POST">
                <input type="email" name="email" placeholder="Email" class="input-text input" autocomplete="off"
                    autofocus required value="<?= @$data["email"] ?>">
                <input type="text" name="subscription_type" placeholder="Subscription Type" class="input-text input"
                    autocomplete="off" autofocus required value="<?= @$data["subscription_type"] ?>">
                <input type="date" name="from" placeholder="Password" class="input-text input" autocomplete="off"
                    autofocus value="<?= @$data['from']; ?>" required>
                <input type="date" name="until" placeholder="Password" class="input-text input" autocomplete="off"
                    autofocus value="<?= @$data['until']; ?>" required>
                <input type="text" name="price" placeholder="Price" class="input-text input" autocomplete="off"
                    autofocus value="<?= @$data['price']; ?>" required>
                <input type="text" name="payment_type" placeholder="Payment Type" class="input-text input"
                    autocomplete="off" autofocus value="<?= @$data['payment_type']; ?>" required>
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