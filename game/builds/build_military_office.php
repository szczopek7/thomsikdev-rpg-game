<?php
/**
 * thomsikdev_rpg - build_military_office.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 08.02.2024
 * Time: 20:49
 * Email: informacje@thomsikdev.pl
 */

/*
 * Objaśnienia
 * Biuro militarne znajduje się tylko w główny mieście kroky
 * Cele budynku:
 * -> Misje
 * -> Warta wysyłam postać na wartę np. 1h - za otrzymujemy 500 złota ???
 * * Jeśli postać jest na warcie nie może wykonywać ekspedycji
 */

$name_of_page = "Biuro Wojskowe";

if($player['city'] !== 1){
    header('Location: /index.php?game=no_exist_build');
    return false;
}

if(isset($_GET['job_worth'])){

    $_GET['job_worth'] = htmlspecialchars($_GET['job_worth']);


    //jeśli jest na wyprawie to nie moze pracować
    try {
        $get_expedition = $db_connect->query("SELECT * FROM expedition WHERE user_id = $player_id LIMIT 1");
        $check_user_on_expedtion = $get_expedition->fetch_assoc();
    } catch (mysqli_sql_exception $e) {
        echo show_error($e);
    }

    if($check_user_on_expedtion){
        $errormsg .= 'Jesteś już na wyprawie więc nie możesz pracować.';
        return false;
    }

    //sprawdzamy czy gracz nie jest w pracy
    try {
        $get_job_work = $db_connect->query("SELECT * FROM job_worth WHERE user_id = $player_id LIMIT 1");
        $check_user_on_work = $get_job_work->fetch_assoc();
    } catch (mysqli_sql_exception $e) {
        echo show_error($e);
    }

    if($check_user_on_expedtion){
        $errormsg .= 'Już pracujesz, musisz czekać do końca pracy.';
        return false;
    }

    if($player['action_points'] < 10){
        $errormsg .= 'Masz za mało punktów akcji, aby pracować minimum to 10.';
        return false;
    }

    if($player['health_current'] < 20){
        $errormsg .= 'Masz za mało zdrowia, aby wyruszyć na wyprawę minimum to 20.';
        return false;
    }

    $_GET['job_worth'] = (int)$_GET['job_worth'];

    //praca 1
    if($_GET['job_worth'] === 1){

        $player_worth_job_type = 1;

        $date_format_start = \Carbon\Carbon::Now()->toDateTimeString();
        $date_format_end = \Carbon\Carbon::Now()->addMinutes(60)->toDateTimeString();

        //ilość pieniędzy
        $salary_chance = drawNumber(1,100);
        // jeśli mniejszy niż 60 dostaniesz tylko 512
        if($salary_chance < 60){
            $salary = $config_game['job_worth_1_money_base'] ;
        }
        // jeśli >= 60 lub < 90 to dostaniesz 512*2
        if($salary_chance >= 60 && $salary_chance < 90){
            $salary = $config_game['job_worth_1_money_base'] ;
        }
        //jesli >= 90 to dostaniesz 512*3
        if($salary_chance >= 90){
            $salary = $config_game['job_worth_1_money_base'] * 3;
        }


        try {
            $sql_start = "INSERT INTO job_worth (user_id, giv_money, date_start, date_end, type)
                        VALUES ('$player_id', '$salary','$date_format_start','$date_format_end','$player_worth_job_type')";
            $start_job_worth = $db_connect->query($sql_start);
        } catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

        if($start_job_worth){
            $expedition_player_action = $player['action_points'] - 10;

            try {
                $db_connect->query("UPDATE users SET action_points = '$expedition_player_action' WHERE id = $player_id");
            } catch (mysqli_sql_exception $e){
                echo show_error($e);
            }

            set_flash_msg('Zaczynasz pracę przy patrolu miasta');
            header('Location: index.php?game=build_military_office');
        }


    }



}

if ($player_get_job_worth_is) {
    $difference_time_now_to_end = 0;
    $current_time = \Carbon\Carbon::Now();
    $job_work_start_info = \Carbon\Carbon::parse($player_get_job_worth_is['date_start']);
    $job_work_end_info = \Carbon\Carbon::parse($player_get_job_worth_is['date_end']);
    $difference_time_now_to_end = $current_time->diffInSeconds($job_work_end_info);
    if ($current_time > $job_work_end_info){
        $difference_time_now_to_end = 0;
    }
    include(BASEDIR . '/template/game/elements/build_military_office_on.php');
}else{
    include(BASEDIR . '/template/game/elements/build_military_office.php');
}


?>
