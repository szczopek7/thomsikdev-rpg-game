<?php
/**
 * thomsikdev_rpg - config_game.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 15.09.2023
 * Time: 20:00
 * Email: informacje@thomsikdev.pl
 */

//utworzenie tablice config_game
$config_game = [];

//ilość doświadczenia potrzebna do awansu
//w pliku player jest exp_need_to_levelup który odnosi się do realnej wartości potrzebnej do zdobycia
//default: exp_to_levelup * level
$config_game['exp_to_levelup'] = 1024;

$config_game['exp_multipler'] = 1;
$config_game['money_multipler'] = 1;
