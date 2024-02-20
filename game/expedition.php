<?php
/**
 * thomsikdev_rpg - expedition.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:05
 * Email: informacje@thomsikdev.pl
 */

$name_of_page = "Wyprawy";

if ($player_get_expedition_is) {
    $difference_time_now_to_end = 0;
    $current_time = \Carbon\Carbon::Now();
    $expedition_start_info = \Carbon\Carbon::parse($player_get_expedition_is['date_start']);
    $expedition_end_info = \Carbon\Carbon::parse($player_get_expedition_is['date_end']);
    $difference_time_now_to_end = $current_time->diffInSeconds($expedition_end_info);
    if ($current_time > $expedition_end_info){
        $difference_time_now_to_end = 0;
    }
    include(BASEDIR . '/template/game/elements/expedition_on.php');
}else{
    include(BASEDIR . '/template/game/elements/expedition_start.php');
}

/*
 * Wyprawa czasowa 1 minut
 * Kosztuje 10 punktów akcji
 */

if(isset($_POST['expedition_type'])){
    $player_expedtion_type = htmlspecialchars($_POST['expedition_type']);
    if(!empty($player_expedtion_type)){

        //sprawdzamy czy gracz nie jest już na wyprawie
        try {
            $get_expedition = $db_connect->query("SELECT * FROM expedition WHERE user_id = $player_id LIMIT 1");
            $check_user_on_expedtion = $get_expedition->fetch_assoc();
        } catch (mysqli_sql_exception $e) {
            echo show_error($e);
        }

        if($check_user_on_expedtion){
            $errormsg .= 'Jesteś już na wyprawie.';
            return false;
        }

        //sprawdzamy czy gracz nie jest w pracy
        try {
            $get_job_work = $db_connect->query("SELECT * FROM job_worth WHERE user_id = $player_id LIMIT 1");
            $check_user_on_work = $get_job_work->fetch_assoc();
        } catch (mysqli_sql_exception $e) {
            echo show_error($e);
        }

        if($check_user_on_work){
            $errormsg .= 'Jesteś w pracy wiec nie możesz brać udziału w wyprawie.';
            return false;
        }

        if($player['action_points'] < 5){
            $errormsg .= 'Masz za mało punktów akcji, aby wyruszyć na wyprawę.';
            return false;
        }

        if($player['health_current'] < 20){
            $errormsg .= 'Masz za mało zdrowia, aby wyruszyć na wyprawę.';
            return false;
        }


        //Czas wyprawy 1 minuta
        $date_format_start = \Carbon\Carbon::Now()->toDateTimeString();
        $date_format_end = \Carbon\Carbon::Now()->addMinutes(1)->toDateTimeString();

        $exp_gain = drawNumber(40, 120) * $config_game['exp_multipler'];

        $exp_gain = number_format($exp_gain, 0, ',', ' ');

        $money_gain = drawNumber(20, 120) * $config_game['money_multipler'];

        $money_gain = number_format($money_gain, 0, ',', ' ');

        $chance_for_dmg = drawNumber(1, 100);
        //10% szans na to że otrzymay obrażenia
        if($chance_for_dmg >= 90){
            $dmg_gain = drawNumber(1, 10);
        }else{
            $dmg_gain = 0;
        }

        try {
            $sql_start = "INSERT INTO expedition (user_id, giv_money, giv_exp, giv_hp, date_start, date_end, type)
                        VALUES ('$player_id', '$money_gain','$exp_gain','$dmg_gain','$date_format_start','$date_format_end','$player_expedtion_type')";
            $start_expedition = $db_connect->query($sql_start);
        } catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        if($start_expedition){
            $expedition_player_action = $player['action_points'] - 5;

            try {
                $db_connect->query("UPDATE users SET action_points = '$expedition_player_action' WHERE id = $player_id");
            } catch (mysqli_sql_exception $e){
                echo show_error($e);
            }

            set_flash_msg('Wyruszyłeś na wyprawę');
            header('Location: index.php?game=expedition');
        }
    }
}


