<?php
/**
 * thomsikdev_rpg - login.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 15.09.2023
 * Time: 19:57
 * Email: informacje@thomsikdev.pl
 */

require ('app/system.php');

$errormsg = "";

if(isset($_POST['login']) && isset($_POST['password'])){
    if(!empty($_POST['login']) || !empty($_POST['password'])){


        //deklaracja zmiennych
        $id = 0;
        $id_found = 0;

        $login = mysqli_real_escape_string($db_connect, $_POST['login']);
        $password = mysqli_real_escape_string($db_connect, $_POST['password']);

        $get_user = mysqli_query($db_connect,'SELECT id,login FROM users');

        foreach ($get_user as $user_value){
            if($user_value['login'] == $login){
                $id = $user_value['id'];
                $id_found++;
            }else{
                $id_found = 0;
            }
        }

        if($id_found == 1){

            $get_user_all = $db_connect->query("SELECT * FROM users WHERE id = '$id' LIMIT 1");
            foreach ($get_user_all as $player_value){
                $user_password = $player_value['password'];
                $user_id = $player_value['id'];
            }

            if(password_verify($password,$user_password)){

                $_SESSION = [];
                session_destroy();
                session_start();
                //@todo: zbudować silniejsza fraze
                $_SESSION['user'] = ( $user_id );
                $session_to_db = sha1($_SERVER['HTTP_USER_AGENT'].time().$_SESSION["user"]);
                $_SESSION['is_logged'] = ( $session_to_db );

                $update_or_insert = 0;
                //dodać warunek, że jeśli jest już jakaś sesja z tym to ma zaktualizować
                $get_sessions = $db_connect->query('SELECT * FROM sessions');

                foreach ($get_sessions as $value_sessions){
                    if($user_id == $value_sessions['user_id']){
                        $update_or_insert++;
                    }
                }

                if($update_or_insert == 0){
                    $db_connect->query("INSERT INTO sessions (user_id, session) VALUES ('$user_id', '$session_to_db')");
                }elseif($update_or_insert == 1){
                    $db_connect->query("UPDATE sessions SET session = '$session_to_db' WHERE user_id = $user_id");
                }else{
                    $db_connect->query("DELETE FROM sessions WHERE user_id = $user_id");
                    header('Location: index.php');
                    exit;
                }

                header( 'Location: game.php?page=welcome' );
                exit;
            }else{
                $errormsg .= 'Błędny login lub hasło 2';
            }
        }else{
            $errormsg .= 'Błędny login lub hasło 1';
        }
    }else{
        $errormsg .= 'Wpisz login lub hasło';
    }
}

    //logowanie po rejestracji
    if(isset($_GET['met']) && $_GET['met'] == "first"){
        $errormsg = "Pomyślnie utworzono konto, teraz się zaloguj.";
    }else{
        unset($_GET['met']);
    }

include('template/page/header.php');
?>


<form method="post" action="/login.php">
    <div class="align-items-center text-center">
        <div class="col-auto">
            <label for="login" class="col-form-label">Login</label>
            <input type="text" id="login" name="login" class="form-control">
        </div>
    </div>
    <div class="align-items-center text-center">
        <div class="col-auto">
            <label for="password" class="col-form-label">Hasło</label>
            <input type="password" id="password" name="password" class="form-control" >
        </div>
    </div>
    <div class="align-items-center text-end margin-space_5">
        <div class="col-auto">
            <button type="submit" class="btn btn-web btn-dark">  &nbsp;  Zaloguj się  &nbsp;  </button>
        </div>
    </div>
</form>



<?php
include('template/page/footer.php');
?>


