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
}

//ilość doświadczenia potrzebna do awansu
$player['exp_need_to_levelup'] = $config_game['exp_to_levelup'] * $player['level'];

//level up
if($player['experience'] >= $player['exp_need_to_levelup']){
    //leveup
    $level_up_str = $player['strength'] + 1;
    $level_up_dex = $player['dexterity'] + 1;
    $level_up_int = $player['intelligence'] + 1;
    $level_up_cha = $player['charisma'] + 1;
    $level_up_vit = $player['vitality'] + 1;
    $level_up_max_hp = $player['health_max'] + 5;
    $level_up_level = $player['level'] + 1;

    $player_exp_to_level_up = $player['experience'] - $player['exp_need_to_levelup'];

    $SQL_level_up = "UPDATE users SET strength = '$level_up_str',
                 dexterity = '$level_up_dex',
                 intelligence = '$level_up_int',
                 charisma = '$level_up_cha',
                 vitality = '$level_up_vit',
                 action_points = '100',
                 health_current = '$level_up_max_hp',
                 health_max = '$level_up_max_hp',
                 level = '$level_up_level',
                 experience = '$player_exp_to_level_up'
                 WHERE id = '$player_id'";

    $player_exec_level_up = $db_connect->query($SQL_level_up);

    if($player_exec_level_up){
        $info_add = "Gracz od id  ".$player_id." awansował na poziom:".$level_up_level;
        $db_connect->query("INSERT INTO system_logs (log) VALUES ('$info_add')");
    }

}


//sprawdzamy czy wyprawa się skończyła

$player_get_expedition = $db_connect->query("SELECT * FROM expedition WHERE user_id = $player_id LIMIT 1");
$player_get_expedition_is = $player_get_expedition->fetch_assoc();

if($player_get_expedition_is){

    //sprawdzamy czy wyprawa sie skocznyła
    foreach ($player_get_expedition as $value_player_get_expedition) {


        if ($system_game_time > $value_player_get_expedition['date_end']) {
//
//            echo $value_player_get_expedition['id'];
            $player_expedition_id = $value_player_get_expedition['id'];
//            echo $value_player_get_expedition['giv_money'];
//            echo $value_player_get_expedition['giv_exp'];
//            echo $value_player_get_expedition['giv_hp'];
            //dodanie zdobytych exp/money dla gracza jesli hp - to

            $hp_player_expeditione = $player['health_current'] - $value_player_get_expedition['giv_hp'];


            if($hp_player_expeditione <= 0){
                $action_point_player = 0;

                $player_expedition_die_sql = "UPDATE users SET action_points = '$action_point_player', health_current = 0 WHERE id = '$player_id'";

                $player_expedition_finish_die_expedition = $db_connect->query($player_expedition_die_sql);

                if($player_expedition_finish_die_expedition){
                    $errormsg .= 'Misja wykonana, postać odniosła poważne obrażenia!';
//                    echo '<div class="alert alert-danger" role="alert">
//                         Jesteś już na wyprawie
//                      </div>';
                }


            }else{
                $money_player_expeditione = $player['money'] + $value_player_get_expedition['giv_money'];
                $experience_player_expeditione = $player['experience'] + $value_player_get_expedition['giv_exp'];

                $player_expedition_sql = "UPDATE users SET money = '$money_player_expeditione', experience = '$experience_player_expeditione', health_current = '$hp_player_expeditione'  WHERE id = '$player_id'";
                $player_expedition_finish_expedition = $db_connect->query($player_expedition_sql);

                if($player_expedition_finish_expedition){
//                    echo '<div class="alert alert-warning" role="alert">
//                         Misja wykonana, król jest zadowolony !
//                      </div>';
                }
            }

            //usun wyprawe
            $db_connect->query("DELETE FROM expedition WHERE id = '$player_expedition_id'");


        }
    }
}
