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

try {
    /**
     *  Pobierz ustawienia z DB
     *  Tabela: game_settings
     */
    $get_base_config_from_db = $db_connect->query('SELECT exp_to_levelup,exp_multipler,money_multipler,action_points_per_5_minutes 
                                                            FROM game_settings LIMIT 1')->fetch_assoc();

    //Przypisz do elementów config_game wartości pobrane z DB
    $config_game['exp_to_levelup'] = $get_base_config_from_db['exp_to_levelup'];
    $config_game['exp_multipler'] = $get_base_config_from_db['exp_multipler'];
    $config_game['money_multipler'] = $get_base_config_from_db['money_multipler'];
    $config_game['action_points_per_5_minutes'] = $get_base_config_from_db['action_points_per_5_minutes'];

}catch (mysqli_sql_exception $e){
    echo show_error($e);
}


