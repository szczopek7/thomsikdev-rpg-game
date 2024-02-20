<?php
/**
 * thomsikdev_rpg - report.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 20.02.2024
 * Time: 22:32
 * Email: informacje@thomsikdev.pl
 */

function create_report_action($text)
{
    //wykorzystaj $db_connect z \app\database.php
    global $db_connect;

    //zmienne
    $text = htmlspecialchars($text);
    $player_id = $_SESSION['user'];
    $status = 1;

    try{
        $sql = "INSERT INTO report_action (user_id,report_text,status) VALUES ('$player_id','$text','$status')";
        $query = $db_connect->query($sql);
    }catch (mysqli_sql_exception $e){
        echo show_error($e);
    }

}