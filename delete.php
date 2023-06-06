<?php 
session_start();
require 'app/db/connection.php';
if (!@$_SESSION['email'] && !@$_SESSION['log'] && !@$_SESSION) {
    $_SESSION["message"] = "Please Log In First!";
    header("Location: index");
}

    $id = @$_GET['id'];
    $query = $connection->prepare("DELETE FROM subscriptions WHERE id = ?");
    $query->bind_param("s", $id);
    $query->execute();


    header("Location: subscriptions");
?>