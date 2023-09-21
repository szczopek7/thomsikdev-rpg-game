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
        $update_or_insert = 0;

        //filtrujemy zmienne
        //@todo: zmodyfikować kiedyś
        $login = mysqli_real_escape_string($db_connect, $_POST['login']);
        $password = mysqli_real_escape_string($db_connect, $_POST['password']);

        //pobierz z bazy danych id i login
        $get_user = mysqli_query($db_connect,'SELECT id,login FROM users');

        //jeśli znaleziono użytkownika dodaj do $id_found =+1
        foreach ($get_user as $user_value){
            if($user_value['login'] == $login){
                $id = $user_value['id'];
                $id_found++;
            }else{
                $id_found = 0;
            }
        }

        //jeśli znaleziono użytkownika dodaj do $id_found =+1
        if($id_found == 1){

            //pobierz użytkownika z bazy danych o znalezionym wcześniej ID przypisanym do wprowadzonego loginu
            $get_user_all = $db_connect->query("SELECT * FROM users WHERE id = '$id' LIMIT 1");

            //pobrane dane do zmiennych
            foreach ($get_user_all as $player_value){
                $user_password = $player_value['password'];
                $user_id = $player_value['id'];
            }

            if(password_verify($password,$user_password)){

                //znisz sesje
                session_destroy();
                //uruchom sesje
                session_start();
                //@todo: zbudować silniejsza fraze
                //zapisz w sesji user=>user_id
                $_SESSION['user'] = ( $user_id );
                //unikalna zaszyfrowana kombinacja ,która ma za zadanie uniemożliwić grzebanie w sesji
                //@todo; podnieść bezpieczeństwo i tak
                $session_to_db = sha1($_SERVER['HTTP_USER_AGENT'].time().$_SESSION["user"]);
                //zapisz w sesji is_logged=>sesje
                $_SESSION['is_logged'] = ( $session_to_db );

                //pobierz z db wszystkie sesje
                $get_sessions = $db_connect->query('SELECT * FROM sessions');

                //sprawdzamy czy jakas sesja dla danego użytkownika już istnieje
                foreach ($get_sessions as $value_sessions){
                    if($user_id == $value_sessions['user_id']){
                        $update_or_insert++;
                    }
                }

                /*
                 * Jeśli sesja nie istnieje {0} - dodaj nową sesje
                 * Jeśli sesja istnieje {1} - zaktualizuj sesje
                 * Jeśli sesji jest więcej niż jedna {?} - ktoś kombinował i go wylogowujemy i usuway wszystkie sesje
                 */
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


