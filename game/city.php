<?php
/**
 * thomsikdev_rpg - city.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:05
 * Email: informacje@thomsikdev.pl
 */

/*
 * @TODO: Poprawić wygląd, może ikony dla budynków?
 *
 */


//player city
$player_city = $player['city'];

$get_City = $db_connect->query("SELECT * FROM city WHERE id = '$player_city' AND status = 1 LIMIT 1")->fetch_assoc();

if($player_city === 1){
    //definicja budynków dla Kroky
    $city_array= [ 'build_military_office' => 'Biuro Wojskowe',
        'build_healer' => 'Uzdrowicielka'];
}elseif ($player_city === 2){
    //definicja budynków dla Morine
    $city_array= [ 'aaa' => 'aaa'];
}elseif ($player_city === 3){
    //definicja budynków dla Nova
    $city_array= [ 'aaa' => 'aaa'];
}else{
    header('Location: index.php?game=map');
}

if(!$get_City){
    try{
        $db_connect->query("UPDATE users SET city = '1' WHERE id = '$player_id'");
        $_game_php_error_msg = "Gracz był w nieistniejący mieście id gracza: ".$player_id;
        $db_connect->query("INSERT INTO system_logs (tag,log) VALUES ('city_error', '$_game_php_error_msg')");
    }catch (mysqli_sql_exception $e){
        echo show_error($e);
    }
}

include(BASEDIR . '/template/game/elements/city.php');

?>
