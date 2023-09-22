<?php
/**
 * thomsikdev_rpg - profile.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:05
 * Email: informacje@thomsikdev.pl
 */
require_once ('file_exist.php');

$name_of_page = "Profil";

?>

<div class="post">
    <p><h3 class="text-start"><?php echo $name_of_page;?> </h3></p>

    <div class="row">
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end"><h6>Witaj,</h6></li>
                <li class="list-group-item list-group-item-secondary text-center"><h5>%nazwa postaci%</h5></li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end"><h6>Znajduje się obecnie w mieście</h6></li>
                <li class="list-group-item list-group-item-secondary text-center"><h5>%nazwa miasta%</h5></li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end"><h6>Należysz do</h6></li>
                <li class="list-group-item list-group-item-secondary text-center"><h5>Brak gildii</h5></li>
            </ul>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end"> <u>Poziom:</u></li>
            </ul>
        </div>
        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text"> %555%</li>
            </ul>
        </div>

        <div class="col-8">
            <p class="text-center">Doświadczenie: %100% / %100% </p>
            <div class="progress">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end">Siła:</li>
                <li class="list-group-item list-group-item-secondary text-end">Zręczność: </li>
                <li class="list-group-item list-group-item-dark text-end">Charyzma:</li>
                <li class="list-group-item list-group-item-secondary text-end">Żywotność:</li>
                <li class="list-group-item list-group-item-dark text-end">Inteligencja:</li>
            </ul>
        </div>

        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark"><u>%22%</u></li>
                <li class="list-group-item list-group-item-secondary"><u>%22%</u></li>
                <li class="list-group-item list-group-item-dark"><u>%22%</u></li>
                <li class="list-group-item list-group-item-secondary"><u>%22%</u></li>
                <li class="list-group-item list-group-item-dark"><u>%22%</u></li>
            </ul>
        </div>

        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end">DPS:</li>
                <li class="list-group-item list-group-item-secondary text-end">Szansa na cios krytyczny: </li>
            </ul>
        </div>

        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark"><u>%22%</u></li>
                <li class="list-group-item list-group-item-secondary"><u>%22%</u></li>
            </ul>
        </div>
    </div>

</div>
