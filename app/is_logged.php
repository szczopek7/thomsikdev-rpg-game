<?php
/**
 * thomsikdev_rpg - is_logged.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 23.10.2023
 * Time: 23:23
 * Email: informacje@thomsikdev.pl
 */

if(get_session("thomsikdevlocal") !== true){
    destroy_session();
}

if(is_numeric(get_session("user")) !== true){
    destroy_session();
}

if(get_session("is_logged")){

    $user_exist_session = htmlspecialchars(get_session("is_logged"));
    $user_exist_id = htmlspecialchars(get_session("user"));

    try{
        $user_exist = $db_connect->query("SELECT user_id,session FROM sessions
                       WHERE session = '$user_exist_session' AND user_id = '$user_exist_id' LIMIT 1")->fetch_assoc();
    }catch (mysqli_sql_exception $e){
        echo show_error($e);
    }

    if( $user_exist['user_id'] !== $user_exist_id){
        destroy_session();
    }

    if(!$user_exist){
        destroy_session();
    }

}else{
    destroy_session();
}