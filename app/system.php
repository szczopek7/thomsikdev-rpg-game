<?php
/**
 * thomsikdev_rpg - system.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 15.09.2023
 * Time: 20:01
 * Email: informacje@thomsikdev.pl
 */

require ('./config/config.php');
require ('./config/config_game.php');

//deklaracja zmiennej error
$errormsg = "";
$infomsg = "";

//błędy PHP
if(DEV_MODE){
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

//ustawienie PHPSESSID
ini_set('session.name','PHPSESSID');
//start sesji
session_start();
//start bufora
ob_flush();

//włączenie wyświetlania błędy mysqli
if(DEV_MODE){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}


$db_connect = mysqli_connect($_hostdb, $_username, $_password, $_database,$_hostport);

$db_connect->set_charset('utf8mb4');

if (mysqli_connect_errno()) {
    throw new RuntimeException('mysqli connection error: ' . mysqli_connect_error());
}

//czas gry
$system_game_time = date("Y-m-d H:i:s");