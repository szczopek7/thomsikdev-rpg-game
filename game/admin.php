<?php
/**
 * thomsikdev_rpg - shop.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 17:05
 * Email: informacje@thomsikdev.pl
 */
require_once ('file_exist.php');

$name_of_page = "Admin Panel";

$action = $_GET['action'];

switch ($action) {
    //add action_points
    case 1:
        $db_connect->query("UPDATE users SET action_points = 100 WHERE id = $player_id");
        echo 'Dodano pkt aktywności';
        break;
    case 2:
        $db_connect->query("UPDATE users SET action_points = 0 WHERE id = $player_id");
        echo 'Dodano pkt aktywności';
        break;
    default:
        echo "Wybierz akcje";

}

?>

<div class="post">
    <p><h3 class="text-start"><?php echo $name_of_page;?> </h3></p>
    <p>
        <a href="game.php?page=admin&action=1"><button class="btn btn-info">Dodaj punkty aktywności</button></a>
        <hr>
        <a href="game.php?page=admin&action=2"><button class="btn btn-info">Usuń punkty aktywności</button></a>
        <hr>
    </p>
</div>
