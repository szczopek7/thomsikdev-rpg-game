<?php
/**
 * thomsikdev_rpg - sidebar.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:50
 * Email: informacje@thomsikdev.pl
 */
?>

<ul class="list-group text-center">
    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">POSTAĆ</li></a>
    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">EKWIPUNEK</li></a>
    <a href="/index.php?game=expedition"><li class="list-group-item list-group-item-dark">WYPRAWY</li></a>
<!--    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">RYNEK</li></a>-->
<!--    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">SKLEP</li></a>-->
    <a href="/index.php?game=map"><li class="list-group-item list-group-item-dark">MAPA</li></a>
    <a href="/index.php?game=city"><li class="list-group-item list-group-item-dark"><?php echo $game_player_city_name; ?></li></a>


<!--    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">ZADANIA</li></a>-->
<!--    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">WIADOMOŚCI</li></a>-->
    <a href="/index.php?game=report"><li class="list-group-item list-group-item-dark">RAPORTY</li></a>
<!--    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">GILDIA</li></a>-->
<!--    <a href="/index.php?game=profile"><li class="list-group-item list-group-item-dark">USTAWIENIA</li></a>-->
    <a href="/index.php?game=logout"><li class="list-group-item list-group-item-dark">WYLOGUJ</li></a>
<!--    --><?php //if(DEV_MODE){
//    ?>
<!--    <hr>-->
<!--    <a href="/game.php?page=admin"><li class="list-group-item list-group-item-dark">ADMIN</li></a>-->
<!--        --><?php
//    }
//    ?>
</ul>
