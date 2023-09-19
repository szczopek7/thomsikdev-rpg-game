<?php
/**
 * thomsikdev_rpg - logout.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 18:27
 * Email: informacje@thomsikdev.pl
 */

session_start();

$_SESSION = [];
unset( $_SESSION );
session_unset();
session_destroy();

header( 'Location: index.php' );
exit;