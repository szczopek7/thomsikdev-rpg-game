<?php
/**
 * thomsikdev_rpg - 1_minutes_cron.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 18:17
 * Email: informacje@thomsikdev.pl
 */

//co każde 5 minut dodaj wszystkim 10 action point (chyba że mają 100, wtedy nic)
//@TODO: Przerobić na CARBON

require('/volume1/web/thomsikdev_rpg/vendor/autoload.php');
const BASEDIR = "/volume1/web/thomsikdev_rpg";
//env load
$dotenv = Dotenv\Dotenv::createImmutable(BASEDIR);
$dotenv->Load();

//connect to DB
$db_connect = mysqli_connect($_ENV['DB_hostdb'], $_ENV['DB_username'], $_ENV['DB_password'], $_ENV['DB_database'],$_ENV['DB_hostport']);
//set charset for DB
$db_connect->set_charset('utf8mb4');

//check errors of DB
if (mysqli_connect_errno()) {
    throw new RuntimeException('mysqli connection error: ' . mysqli_connect_error());
}

require_once ('/volume1/web/thomsikdev_rpg/config/config_game.php');
//require_once ('../config/config_game.php');

$system_game_time = date("Y-m-d H:i:s");

$get_all_users = $db_connect->query("SELECT id,action_points,date_action_points FROM users 
                        WHERE status = 1 AND action_points < 100 AND date_action_points < '$system_game_time' LIMIT 10000");

foreach ($get_all_users as $single_user){

    $single_user_id = $single_user['id'];
    $single_user_action_points = $single_user['action_points'];

    if($single_user_action_points >= 90){
        $new_action_points = 100;
    }else{
        $new_action_points = $single_user_action_points + $config_game['action_points_per_5_minutes'];
        if($new_action_points > 100){
            $new_action_points = 100;
        }
    }

    $date_next_add_action_points = date("Y-m-d H:i:s", strtotime($system_game_time . "+5 minutes"));

    try {
        //Dodaj punkty SQL
        $SQL = "UPDATE users SET action_points = '$new_action_points', date_action_points = '$date_next_add_action_points' 
             WHERE id = '$single_user_id'";
        //Wykonaj zapytanie
        $add_action_points = $db_connect->query($SQL);
    } catch (mysqli_sql_exception $e){
        echo show_error($e);
    }

}

$db_connect->query("UPDATE game_settings SET last_update_action_points = '$system_game_time'");




