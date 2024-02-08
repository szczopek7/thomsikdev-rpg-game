<?php
/**
 * thomsikdev_rpg - profile.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:05
 * Email: informacje@thomsikdev.pl
 */

$name_of_page = "Profil";

//oblicza procentowa wartosc doswiadczenia do progress bar
$exp_need_to_levelup_percent = ($player['experience'] / $player['exp_need_to_levelup'])*100;

include(BASEDIR . '/template/game/elements/profile.php');

?>
