<?php
/**
 * thomsikdev_rpg - expedition.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:05
 * Email: informacje@thomsikdev.pl
 */
require_once ('file_exist.php');
$name_of_page = "Wyprawy";

/*
 * Wyprawa czasowa 1 minut
 * Kosztuje 10 punktów akcji
 *
 */

if(isset($_POST['expedition_type'])){
    $player_expedtion_type = mysqli_real_escape_string($db_connect, $_POST['expedition_type']);
    if(!empty($player_expedtion_type)){

        //sprawdzamy czy gracz nie jest już na wyprawie
        $get_expedition = $db_connect->query("SELECT * FROM expedition WHERE user_id = $player_id LIMIT 1");
        $check_user_on_expedtion = $get_expedition->fetch_assoc();

        if(!$check_user_on_expedtion){
            if($player['action_points'] > 10 && $player['health_current'] > 10){


                $date_format_start = date("Y-m-d H:i:s");
                $date_format_end = date("Y-m-d H:i:s", strtotime($date_format_start . "+1 minutes"));

                $exp_gain = rand(40,120);
                $exp_gain = $exp_gain * $config_game['exp_multipler'];

                $money_gain = rand(20,120);
                $money_gain = $money_gain * $config_game['money_multipler'];

                $chance_for_dmg = rand (1,100);
                //10% szans na to że otrzymay obrażenia
                if($chance_for_dmg >= 90){
                    $dmg_gain = rand(1,10);
                }else{
                    $dmg_gain = 0;
                }

                $sql_start = "INSERT INTO expedition (user_id, giv_money, giv_exp, giv_hp, date_start, date_end, type)
                    VALUES ('$player_id', '$money_gain','$exp_gain','$dmg_gain','$date_format_start','$date_format_end','$player_expedtion_type')";

                $start_expedition = $db_connect->query($sql_start);

                if($start_expedition){
                    $expedition_player_action = $player['action_points'] - 10;
                    $db_connect->query("UPDATE users SET action_points = '$expedition_player_action' WHERE id = $player_id");

                    echo '<div class="alert alert-warning" role="alert">
                         Wyruszyłeś na wyprawę
                      </div>';

                }
        }else{
                echo '<div class="alert alert-danger" role="alert">
                         Masz za mało zdrowia lub punktów akcji aby wyruszyć na wyprawę.
                      </div>';
        }



            echo $infomsg;

        }else{
            echo '<div class="alert alert-danger" role="alert">
                         Jesteś już na wyprawie
                      </div>';
        }


    }
}

?>

<div class="post">
    <p><h3 class="text-start"><?php echo $name_of_page;?> </h3></p>

    <div class="card">
        <form action="game.php?page=expedition" method="post">
            <input type="text" style="visibility: hidden;" value="1" id="expedition_type" name="expedition_type" readonly>
            <div class="row">
                <div class="col-6">
                    <img src="/assets/gfx/expedition_1.jpg" class="img-fluid rounded border-secondary" style="padding: 25px;" alt="wyprawa">
                </div>
                <div class="col-6">
                    <h3 style="color:white;">Ochrona szlaków kupieckich</h3>
                    <p style="color:white;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 offset-6">
                    <button class="btn btn-outline-danger" type="submit">Wyślij na wyprawe</button>
                </div>
            </div>
            <br>

        </form>
    </div>


</div>
