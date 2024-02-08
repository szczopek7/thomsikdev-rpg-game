<?php
/**
 * thomsikdev_rpg - session.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 23.10.2023
 * Time: 23:07
 * Email: informacje@thomsikdev.pl
 */

/**
 * @param $key -> Session name
 * @return Session Value or False
 */
function get_session($key) {
    return $_SESSION[$key] ?? false;
}

/**
 * Logout, Session Destroy
 * @return void
 */
function destroy_session(): void
{
    $_SESSION = [];
    unset( $_SESSION );
    session_unset();
    session_destroy();

    header( 'Location: index.php' );
    exit;
}

/**
 * Create flasg MSG
 * @param $value -> Msg
 * @return mixed
 */
function set_flash_msg($value){
    return $_SESSION['flash_message'] = $value;
}

/**
 * Show flash msg
 * @return void
 */
function show_flash_msg(): void
{
    if($_SESSION['flash_message'] !== "Brak"){
        $text = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        echo '<div class="alert alert-warning" style="color:#390011" role="alert">'.$text.'</div>';
    }else{
        echo '<div class="alert alert-warning" style="color: rgba(56,64,61,0.44)" role="alert"> Brak powiadomień</div>';
    }
}