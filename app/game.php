<?php
/**
 *
 * thomsikdev_rpg - game.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 23.10.2023
 * Time: 22:58
 * Email: informacje@thomsikdev.pl
 */

require (BASEDIR . '/config/config_game.php');
require (BASEDIR . '/func/random.php');

$system_game_time = \Carbon\Carbon::Now()->toDateTimeString();

//utworzenie tablice player
$player = [];

//player_id => int(), player_id jest definiowany przy logowaniu w pliku login.php
$player_id = $_SESSION['user'];

    //pobierz wybrane dane z bazy danych dla danego gracza
    try {
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
        health_max FROM users WHERE id = '$player_id' LIMIT 1")->fetch_assoc();
    }catch (mysqli_sql_exception $e){
        echo show_error($e);
    }

    //przypisz dane z DB do zdefiniowanych w tablicy player wartości
    $player['character_name'] = (string)$get_player_info['character_name'];
    $player['experience'] = $get_player_info['experience'];
    $player['money'] = $get_player_info['money'];
    $player['level'] = $get_player_info['level'];
    $player['city'] = (int)$get_player_info['city'];
    $player['health_max'] = $get_player_info['health_max'];
    $player['action_points'] = $get_player_info['action_points'];
    $player['vitality'] = $get_player_info['vitality'];
    $player['strength'] = $get_player_info['strength'];
    $player['dexterity'] = $get_player_info['dexterity'];
    $player['intelligence'] = $get_player_info['intelligence'];
    $player['charisma'] = $get_player_info['charisma'];
    $player['health_current'] = $get_player_info['health_current'];


//ilość doświadczenia potrzebna do awansu
$player['exp_need_to_levelup'] = $config_game['exp_to_levelup'] * $player['level'];

    //level up
    if ($player['experience'] >= $player['exp_need_to_levelup']) {
        //leveup
        $level_up_str = $player['strength'] + 1;
        $level_up_dex = $player['dexterity'] + 1;
        $level_up_int = $player['intelligence'] + 1;
        $level_up_cha = $player['charisma'] + 1;
        $level_up_vit = $player['vitality'] + 1;
        $level_up_max_hp = $player['health_max'] + 5;
        $level_up_level = $player['level'] + 1;

        $player_exp_to_level_up = $player['experience'] - $player['exp_need_to_levelup'];

        //Update stats when user level up
        try{
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
        }catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        try{
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
        }catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        if ($player_exec_level_up) {
            $info_add = "Gracz od id  " . $player_id . " awansował na poziom:" . $level_up_level;
            try{
                $db_connect->query("INSERT INTO system_logs (tag,log) VALUES ('level_up', '$info_add')");
            }catch (mysqli_sql_exception $e){
                echo show_error($e);
            }
        }
    }


//pobieramy informacje o wyprawach gracza
try{
    $player_get_expedition = $db_connect->query("SELECT * FROM expedition WHERE user_id = $player_id LIMIT 1");
    $player_get_expedition_is = $player_get_expedition->fetch_assoc();
}catch (mysqli_sql_exception $e){
    echo show_error($e);
}


    if ($player_get_expedition_is) {
        //sprawdzamy czy wyprawa sie skocznyła
        foreach ($player_get_expedition as $value_player_get_expedition) {
            if ($system_game_time > $value_player_get_expedition['date_end']) {

                $player_expedition_id = $value_player_get_expedition['id'];

                $hp_player_expeditione = $player['health_current'] - $value_player_get_expedition['giv_hp'];

                //jeśli hp < 0
                if ($hp_player_expeditione <= 0) {
                    $action_point_player = 0;

                    try{
                        $player_expedition_die_sql = "UPDATE users SET action_points = '$action_point_player', health_current = 0 WHERE id = '$player_id'";
                        $player_expedition_finish_die_expedition = $db_connect->query($player_expedition_die_sql);

                    }catch (mysqli_sql_exception $e){
                        echo show_error($e);
                    }

                    if ($player_expedition_finish_die_expedition) {
                        $errormsg .= 'Misja wykonana, postać odniosła poważne obrażenia!';
                    }
                } else {
                    $money_player_expeditione = $player['money'] + $value_player_get_expedition['giv_money'];
                    $experience_player_expeditione = $player['experience'] + $value_player_get_expedition['giv_exp'];

                    try{
                        $player_expedition_sql = "UPDATE users SET money = '$money_player_expeditione', experience = '$experience_player_expeditione', health_current = '$hp_player_expeditione'  WHERE id = '$player_id'";
                        $player_expedition_finish_expedition = $db_connect->query($player_expedition_sql);
                    }catch (mysqli_sql_exception $e){
                        echo show_error($e);
                    }

                    if ($player_expedition_finish_expedition) {
                        set_flash_msg('Ukończyłeś wyprawę');
                    }
                }

                try{
                    //usun wyprawe
                    $db_connect->query("DELETE FROM expedition WHERE id = '$player_expedition_id'");
                }catch (mysqli_sql_exception $e){
                    echo show_error($e);
                }

            }
        }
    }

//pobieramy informacje o pracach gracza
try{
    $player_get_job_worth = $db_connect->query("SELECT * FROM job_worth WHERE user_id = $player_id LIMIT 1");
    $player_get_job_worth_is = $player_get_job_worth->fetch_assoc();
}catch (mysqli_sql_exception $e){
    echo show_error($e);
}


if ($player_get_job_worth_is) {
    //sprawdzamy czy wyprawa sie skocznyła
    foreach ($player_get_job_worth as $value_player_get_job_worth) {
        if ($system_game_time > $value_player_get_job_worth['date_end']) {

            $player_job_worth_id = $value_player_get_job_worth['id'];

            $money_player_worth  = $player['money'] + $value_player_get_job_worth['giv_money'];

            try{
                $player_worth_sql = "UPDATE users SET money = '$money_player_worth' WHERE id = '$player_id'";
                $player_job_worth_finish = $db_connect->query($player_worth_sql);
            }catch (mysqli_sql_exception $e){
                echo show_error($e);
            }

            if ($player_job_worth_finish) {
                set_flash_msg('Ukończyłeś pracę');
            }

            try{
                //usun wyprawe
                $db_connect->query("DELETE FROM job_worth WHERE id = '$player_job_worth_id'");
            }catch (mysqli_sql_exception $e){
                echo show_error($e);
            }

        }
    }
}

    //City name set @TODO: Przerobić z DB

    try{
        $get_All_Cities = $db_connect->query("SELECT * FROM city WHERE status = 1");
    }catch (mysqli_sql_exception $e){
        echo show_error($e);
    }

    if($player['city'] === 1){
        $game_player_city_name = "Kroky";
    }

    if($player['city'] === 2){
        $game_player_city_name = "Morine";
    }

    if($player['city'] === 3){
        $game_player_city_name = "Nova";
    }

    $get_All_Cities_Num = mysqli_num_rows($get_All_Cities);

    //City check exist
    if($player['city'] > $get_All_Cities_Num){
        $game_player_city_name = "Błąd, czekasz na teleport do domu ...";
        try{
            $db_connect->query("UPDATE users SET city = '1' WHERE id = '$player_id'");
            $_game_php_error_msg = "Gracz wybrał niestniejące miasto na mapie id gracza: ".$player_id;
            $db_connect->query("INSERT INTO system_logs (tag,log) VALUES ('map_error', '$_game_php_error_msg')");
        }catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

    }


