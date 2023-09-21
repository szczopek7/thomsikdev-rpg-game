<?php
/**
 * thomsikdev_rpg - login.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 15.09.2023
 * Time: 19:57
 * Email: informacje@thomsikdev.pl
 */

require ('app/system.php');

$errormsg = " ";

if(isset($_POST['login']) && isset($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['character_name'])){
    if(!empty($_POST['login']) || !empty($_POST['password']) || !empty($_POST['password2']) || !empty($_POST['character_name'])){
        if(strlen($_POST['password']) > 3){
            if($_POST['password'] == $_POST['password2']){

                //filtrujemy zmienne
                //@todo: zmodyfikować kiedyś
                $login = mysqli_real_escape_string($db_connect, $_POST['login']);
                $password = mysqli_real_escape_string($db_connect, $_POST['password']);
                $password2 = mysqli_real_escape_string($db_connect, $_POST['password2']);
                $character_name = mysqli_real_escape_string($db_connect, $_POST['character_name']);

                /*
                 * jeśli znaleziono cokolwiek, to wyświetl błąd
                 * sprawdza: login, character_name, not_use_login
                 */
                $found = 0;

                //pobierz loginy z bazy users
                $get_login = $db_connect->query('SELECT login FROM users');
                //pobierz nazwy postaci z bazy users
                $get_character_name = $db_connect->query('SELECT character_name FROM users');;

                //sprawdzenie, czy dany login już istnieje,
                //jeśli tak to dodaj znalezienie do zmiennej $found;
                foreach ($get_login as $login_value){
                    if($login_value == $login){
                        $found++;
                    }
                }

                //sprawdzenie, czy dana nazwa postaci już istnieje,
                //jeśli tak to dodaj znalezienie do zmiennej $found;
                foreach ($get_character_name as $character_name_value){
                    if($character_name_value == $character_name){
                        $found++;
                    }
                }

                //@todo;przerobić na tablice
                if($login == 'admin' || $character_name == 'admin' || $login == 'administrator' || $login == 'administrator' || $character_name == 'root' || $login == 'root'){
                    $found++;
                    $errormsg .= 'Nice try';
                }

                //@todo; dopisać restrykcje dot hasła 8 znaków, nie może być jak login etc;

                if($login == $password){
                    $found++;
                    $errormsg .= "Login nie może być hasłem. ";
                }

                if($found == 0){

                    //Password hash
                    $options = [
                        'cost' => 4,
                    ];
                    $password = password_hash($password, PASSWORD_BCRYPT, $options);

                    //jeśli nie ma problemów zapisz/rejestruj gracza w bazie danych
                    $sql = "INSERT INTO users (login, password, character_name) VALUES ('$login', '$password', '$character_name')";

                    if($db_connect->query($sql)){
                        //jeśli poprawnie zarejestrowano przenieś do strony logownia
                        header("Location: login.php?met=first");
                    }else{
                        $errormsg .= "Coś poszło nie tak, spróbój ponownie";
                    }

                }else{
                    $errormsg .= "Podana nazwa postaci lub login są zajęte spróbuj innej kombinacji";
                }
            }else{
                $errormsg .= 'Hasła się nie zgadzają';
            }
        }else{
            $errormsg .= 'Hasło musi mieć więcej niż 3 znaki';
        }
    }else{
        $errormsg .= 'Nie wpisano wszystkich danych';
    }
}

include('template/page/header.php');
?>

<div class="post">
    <form method="POST" action="register.php">
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
                <button type="submit" class="btn btn-web btn-dark">Zaloguj się</button>
            </div>
        </div>
    </form>
</div>




<?php
//załaduj stopkę strony
include('template/page/footer.php');
?>


