<?php
/**
 * thomsikdev_rpg - database.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 23.10.2023
 * Time: 23:22
 * Email: informacje@thomsikdev.pl
 */

//connect to DB
$db_connect = mysqli_connect($_ENV['DB_hostdb'], $_ENV['DB_username'], $_ENV['DB_password'], $_ENV['DB_database'],$_ENV['DB_hostport']);
//set charset for DB
$db_connect->set_charset('utf8mb4');

//check errors of DB
if (mysqli_connect_errno()) {
    throw new RuntimeException('mysqli connection error: ' . mysqli_connect_error());
}