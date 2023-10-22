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

$config_game_base = $db_connect->query('SELECT exp_to_levelup,exp_multipler,money_multipler,action_points_per_5_minutes FROM game_settings LIMIT 1');

foreach ($config_game_base as $config_game_value){
    $config_game['exp_to_levelup'] = $config_game_value['exp_to_levelup'];
    $config_game['exp_multipler'] = $config_game_value['exp_multipler'];
    $config_game['money_multipler'] = $config_game_value['money_multipler'];
    $config_game['action_points_per_5_minutes'] = $config_game_value['action_points_per_5_minutes'];
}

