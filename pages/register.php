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
    <form method="POST" action="index.php?page=register">
        <div class="align-items-center text-center">
            <div class="col-auto">
                <label for="login" class="col-form-label">Login</label>
                <input type="text" id="login" name="login" class="form-control">
            </div>
        </div>
        <div class="align-items-center text-center">
            <div class="col-auto">
                <label for="character_name" class="col-form-label">Nazwa postaci</label>
                <input type="text" id="character_name" name="character_name" class="form-control">
            </div>
        </div>
        <div class="align-items-center text-center">
            <div class="col-auto">
                <label for="password" class="col-form-label">Hasło</label>
                <input type="password" id="password" name="password" class="form-control" >
            </div>
        </div>
        <div class="align-items-center text-center">
            <div class="col-auto">
                <label for="password2" class="col-form-label">Powtórz hasło</label>
                <input type="password" id="password2" name="password2" class="form-control" >
            </div>
        </div>
        <div class="align-items-center text-end margin-space_5">
            <div class="col-auto">
                <button type="submit" class="btn btn-web btn-dark">Zarejestruj się</button>
            </div>
        </div>
    </form>
</div>

<?php

if(isset($_POST['login'], $_POST['password'], $_POST['password2'], $_POST['character_name'])){

        //filtrowanie zmiennych post
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $character_name = htmlspecialchars($_POST['character_name']);

        //Restrykcje co do długości haseł
        $configRegister['login_min'] = 1;
        $configRegister['login_max'] = 64;
        $configRegister['password_min'] = 1;
        $configRegister['password_max'] = 255;
        $configRegister['character_name_min'] = 1;
        $configRegister['character_name_max'] = 64;

        if(!$login || !$password || !$password2 || !$character_name){
            $errormsg .= "Nie wypełniłeś wszystkich pól";
            return false;
        }

        if($configRegister['login_min'] > strlen($login)){
            $errormsg .= "Login jest za krótki";
            return false;
        }

        if($configRegister['login_max'] < strlen($login)){
            $errormsg .= "Login jest za długi";
            return false;
        }

        if($password !== $password2){
            $errormsg .= "Hasła się nie zgadzają";
            return false;
        }

        if($login === $password){
            $errormsg .= "Login nie może być hasłem";
            return false;
        }

        if($character_name === $password){
            $errormsg .= "Nazwa postaci nie może być hasłem";
            return false;
        }

        if($configRegister['password_min'] > strlen($password)){
            $errormsg .= "Login jest za krótki";
            return false;
        }

        if($configRegister['password_max'] < strlen($password)){
            $errormsg .= "Login jest za długi";
            return false;
        }

        if($configRegister['character_name_min'] > strlen($character_name)){
            $errormsg .= "Login jest za krótki";
            return false;
        }

        if($configRegister['character_name_max'] < strlen($character_name)){
            $errormsg .= "Login jest za długi";
            return false;
        }

        /*
        *   TODO: w DB + lista zakazanych słów?
        *   TODO: poza słowami dodać wyszukiwanie po podobnych słowach
        */

        $arrayRestricedNameAndLogins = ['admin', 'administrator', 'root', 'thomsikdev'];

        if(in_array($login,$arrayRestricedNameAndLogins) || in_array($character_name,$arrayRestricedNameAndLogins)){
            $errormsg .= "Login lub nazwa postaci jest na liście zakazanej";
            return false;
        }

        $get_user_if_exist = $db_connect->query("SELECT login, character_name FROM users 
                                               WHERE login = '$login' OR character_name = '$character_name' LIMIT 1")->fetch_assoc();
        if($get_user_if_exist){
            $errormsg .= "Wybrana nazwa postaci lub login są już zajęte";
            return false;
        }

        try{
            $optionsPassword = [
                'cost' => 6,
            ];
            $password = password_hash($password, PASSWORD_BCRYPT, $optionsPassword);
            $sql = "INSERT INTO users (login, password, character_name) VALUES ('$login', '$password', '$character_name')";
            $db_connect->query($sql);
            header("Location: index.php?page=login&met=first");
            return true;
        }catch (mysqli_sql_exception $e){
            echo show_error($e);
            session_destroy();
        }

        $errormsg .= "Coś poszło nie tak";
        return false;
}

?>


