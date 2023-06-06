<?php
$username = 'root';
$password = '';
$host = 'localhost';
$dbname = 'wdcadminef';



$connection = mysqli_connect($host, $username, $password);


$databaseC = $connection->query("CREATE DATABASE IF NOT EXISTS $dbname");
$connection = mysqli_connect($host, $username, $password, $dbname);

$usersTableQuery = <<<EOF
             CREATE TABLE IF NOT EXISTS `users` (
                 `id` INT(11) NOT NULL AUTO_INCREMENT ,
                 `username` VARCHAR(36) NOT NULL ,
                 `email` VARCHAR(400) NOT NULL ,
                 `password` VARCHAR(250) NOT NULL ,
                 PRIMARY KEY (`id`)
             );
         EOF;

$booksTableQuery = <<<EOF
             CREATE TABLE IF NOT EXISTS `subscriptions` (
                 `id` INT(11) NOT NULL AUTO_INCREMENT,
                 `email` VARCHAR(400) NOT NULL,
                 `subscription_type` VARCHAR(50) NOT NULL,
                 `from` DATE NOT NULL,
                 `until` DATE NOT NULL,
                 `price` VARCHAR(500) NOT NULL,
                 `payment_type` VARCHAR(80) NOT NULL,
                 `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user' ,
                 PRIMARY KEY (`id`)
             );
         EOF;
$connection->query($usersTableQuery);
$connection->query($booksTableQuery);
