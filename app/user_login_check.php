<?php
/**
 * thomsikdev_rpg - user_login_check.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 21:46
 * Email: informacje@thomsikdev.pl
 */

//sprawdzamy czy użytkownik jest zalogowany i czy nie grzebał przy sesji
if(isset($_SESSION['user']) && isset($_SESSION['is_logged'])){
        $user_exist_session = mysqli_real_escape_string($db_connect, $_SESSION['is_logged']);
        $user_exist_id = mysqli_real_escape_string($db_connect, $_SESSION['user']);
        $user_exist = $db_connect->query("SELECT user_id FROM sessions WHERE session = '$user_exist_session' LIMIT 1")->fetch_assoc();

        if( $user_exist['user_id'] != $user_exist_id){
            header( "Location: /logout.php");
            exit;
        }

        if(!$user_exist){
            header( "Location: /logout.php");
            exit;
        }
}else{
    header( "Location: /login.php");
    exit;
}