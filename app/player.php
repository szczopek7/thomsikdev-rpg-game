<?php
/**
 * thomsikdev_rpg - player.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 22.09.2023
 * Time: 18:25
 * Email: informacje@thomsikdev.pl
 */

//utworzenie tablice player
$player = [];

//player_id => int(), player_id jest definiowany przy logowaniu w pliku login.php
$player_id = $_SESSION['user'];

//pobierz wybrane dane z bazy danych dla danego gracza
$get_player_info = $db_connect->query("SELECT character_name, experience, money,
level,
city,
action_points,
vitality,
strength,
dexterity,
intelligence,
charisma,
health_current,
health_max FROM users WHERE id = '$player_id' LIMIT 1");

//przypisz dane z DB do zdefiniowanych w tablicy player wartości
foreach ($get_player_info as $get_player_value){
    $player['character_name'] = $get_player_value['character_name'];
    $player['experience'] = $get_player_value['experience'];
    $player['money'] = $get_player_value['money'];
    $player['level'] = $get_player_value['level'];
    $player['city'] = $get_player_value['city'];
    $player['health_max'] = $get_player_value['health_max'];
    $player['action_points'] = $get_player_value['action_points'];
    $player['vitality'] = $get_player_value['vitality'];
    $player['strength'] = $get_player_value['strength'];
    $player['dexterity'] = $get_player_value['dexterity'];
    $player['intelligence'] = $get_player_value['intelligence'];
    $player['charisma'] = $get_player_value['charisma'];
    $player['health_current'] = $get_player_value['health_current'];
    $player['health_max'] = $get_player_value['health_max'];
}

//ilość doświadczenia potrzebna do awansu
$player['exp_need_to_levelup'] = $config_game['exp_to_levelup'] * $player['level'];
