<?php
/**
 * thomsikdev_rpg - build_healer.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 20.02.2024
 * Time: 23:20
 * Email: informacje@thomsikdev.pl
 */


$name_of_page = "Uzdrowiciel";

/*
 * Uzdrowiciel:

Koszt uleczenia:

 50 monet = 50 pkt zdrowia

 100 monet = 150 pkt zdrowia

 200 monet = 300 pkt zdrowia

Tylko w Kroky
 */

if($player['city'] !== 1){
    header('Location: /index.php?game=no_exist_build');
    return false;
}

if(isset($_GET['healer'])){

    if($player['health_max'] === $player['health_current']){
        set_flash_msg('Masz pełny poziom zdrowia, uzdrowiciel cie nie przyjmie.');
        return false;
    }

    $_GET['healer'] = (int)$_GET['healer'];

    //praca 1
    if($_GET['healer'] === 1){
        if($player['money'] < 50){
            set_flash_msg('Nie stać cie na skorzystanie z usług uzdrowiciela.');
            return false;
        }

        $player_money_heal_1 = $player['money'] - 50;
        $player_health_heal_1 = $player['health_current'] + 50;

        if($player_health_heal_1 > $player['health_max']) {
            $player_health_heal_1 = $player['health_max'];
        }

        try {
            $sql_health_1 = "UPDATE users SET health_current = '$player_health_heal_1', money = '$player_money_heal_1' WHERE id = '$player_id'";
            $health_1 = $db_connect->query($sql_health_1);
        } catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        if($health_1){
            set_flash_msg('Uleczono');
        }

        header('Location: index.php?game=build_healer');
    }

    if($_GET['healer'] === 2){

        if($player['money'] < 100){
            set_flash_msg('Nie stać cie na skorzystanie z usług uzdrowiciela.');
            return false;
        }

        $player_money_heal_2 = $player['money'] - 100;
        $player_health_heal_2 = $player['health_current'] + 150;

        if($player_health_heal_2 > $player['health_max']) {
            $player_health_heal_2 = $player['health_max'];
        }

        try {
            $sql_health_1 = "UPDATE users SET health_current = '$player_health_heal_2', money = '$player_money_heal_2' WHERE id = '$player_id'";
            $health_2 = $db_connect->query($sql_health_1);
        } catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        if($health_2){
            set_flash_msg('Uleczono');
        }

        header('Location: index.php?game=build_healer');
    }

    if($_GET['healer'] === 3){

        if($player['money'] < 200){
            set_flash_msg('Nie stać cie na skorzystanie z usług uzdrowiciela.');
            return false;
        }

        $player_money_heal_3 = $player['money'] - 200;
        $player_health_heal_3 = $player['health_current'] + 300;

        if($player_health_heal_3 > $player['health_max']) {
            $player_health_heal_3 = $player['health_max'];
        }

        try {
            $sql_health_1 = "UPDATE users SET health_current = '$player_health_heal_3', money = '$player_money_heal_3' WHERE id = '$player_id'";
            $health_3 = $db_connect->query($sql_health_1);
        } catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        if($health_3){
            set_flash_msg('Uleczono');
        }

        header('Location: index.php?game=build_healer');

    }

}

if($player['health_max'] === $player['health_current']){
    include(BASEDIR . '/template/game/elements/build_healer_full_hp.php');
}else{
    include(BASEDIR . '/template/game/elements/build_healer.php');
}


?>


