<?php
/**
 * thomsikdev_rpg - map.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:52
 * Email: informacje@thomsikdev.pl
 */

// Miasto nr 1 : Nova - Wioska
// Miasto nr 2 : Morine - Wioska
// Miasto nr 3 : kroky - Miasto

$name_of_page = "Mapa podróży";

if(isset($_GET['travel'])){
    $travel_id = htmlspecialchars($_GET['travel']);
    $travel_id = (int)$travel_id;

    if($travel_id > $get_All_Cities_Num){
        return false;
    }else{
        //Jeśli okej przenieś do miasta
        try{
            $db_connect->query("UPDATE users SET city = '$travel_id' WHERE id = '$player_id'");
        }catch (mysqli_sql_exception $e){
            echo show_error($e);
        }

    }

}

?>


<div class="post">
    <div class="row">
        <h3 class="text-start"><?php echo $name_of_page;?> </h3>
    </div>
    <div class="row">
        <p>Obecnie znajdujesz się w: <b><?php echo $game_player_city_name;?></b></p>
        <hr>
        Wybierz jedną z poniższych lokalizacji aby się tam udać:
    </div>

    <?php

    foreach ($get_All_Cities as $get_Single_Cities){

        if($get_Single_Cities["city_name"] !==  $game_player_city_name){
            echo '
            <div class="row">
                <br><br>
                <div class="col-12">
                    Podróż do '.$get_Single_Cities["type_of_city"].' '.$get_Single_Cities["city_name"].'  &nbsp; <a href="index.php?game=map&travel='.$get_Single_Cities["id"].'"> <button class="btn btn-sm btn-dark">Kliknij aby udać się do tego miasta</button></a>
                </div>
                <br><br>
            </div>';
        }
    }

    ?>


</div>
