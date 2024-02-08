<?php
/**
 * thomsikdev_rpg - login.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 15.09.2023
 * Time: 19:57
 * Email: informacje@thomsikdev.pl
 */
?>

<div class="post">
    <form method="post" action="/index.php?page=login">
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
</div>

<?php

if(empty($_GET['met'])){
    $_GET['met'] = "";
}else{
    echo '<div class="alert alert-warning" role="alert">
                Pomyślnie zarejestrowano
          </div>';
}

if(isset($_POST['login'], $_POST['password'])){

        //deklaracja zmiennych
        $id = 0;
        $update_or_insert = 0;

        //filtrujemy zmienne
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        //pobierz z bazy danych id i login
        try{
            $find_user = $db_connect->query("SELECT id,login,status FROM users
                WHERE login = '$login' AND status >= 1 LIMIT 1")->fetch_assoc();
        }catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        if(!$find_user){
            $errormsg .= "Nie ma takiego użytkownika";
            return false;
        }

        $user_id = $find_user['id'];
        $user_password = $db_connect->query("SELECT password FROM users 
            WHERE id = '$user_id' LIMIT 1")->fetch_assoc();

        $verify_password = password_verify($password,$user_password['password']);

        if(empty($verify_password)) {
            $errormsg .= "Wpisz hasło";
            return false;
        }

        // Usuń istniejące sesje, dodaj nową
        try{
            //unikalna zaszyfrowana kombinacja ,która ma za zadanie uniemożliwić grzebanie w sesji
            $session_to_db = sha1($_SERVER['HTTP_USER_AGENT'].time().get_session("user"));
            $db_connect->query("DELETE FROM sessions WHERE user_id = $user_id");
            $db_connect->query("INSERT INTO sessions (user_id, session) VALUES ('$user_id', '$session_to_db')");

        }catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        //zapisz w sesji user : user_id
        $_SESSION['user'] = $user_id;
        //warunek czy jest zalogowany
        $_SESSION['thomsikdevlocal'] = true;
        //zapisz w sesji is_logged=>sesje
        $_SESSION['is_logged'] = $session_to_db;

        session_write_close();
        header( 'Location: index.php?game=welcome');
        exit();
    }

?>


