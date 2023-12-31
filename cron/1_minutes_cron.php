<?php
/**
 * thomsikdev_rpg - 1_minutes_cron.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 18:17
 * Email: informacje@thomsikdev.pl
 */

//co każde 5 minut dodaj wszystkim 10 action point (chyba że mają 100, wtedy nic)
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

require_once ('/volume1/web/thomsikdev_rpg/config/config.php');
//require_once ('../config/config.php');

$db_connect = mysqli_connect($_hostdb, $_username, $_password, $_database,$_hostport);

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

    $SQL = "UPDATE users SET action_points = '$new_action_points', date_action_points = '$date_next_add_action_points' WHERE id = '$single_user_id'";

    $add_action_points = $db_connect->query($SQL);

    $info_add = "CRON Dodano punktów akcji";

    if($add_action_points){
        $db_connect->query("INSERT INTO system_logs (log) VALUES ('$info_add')");
        $db_connect->query("UPDATE game_settings SET last_update_action_points = '$system_game_time'");
    }


}
