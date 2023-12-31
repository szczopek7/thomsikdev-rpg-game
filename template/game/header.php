<?php
    //oblicza procentowa wartosc zdrowia do progress bar
    $health_percent = ($player['health_current'] / $player['health_max'])*100;
    //oblicza procentowa wartosc punktow akcji do progress bar
    $action_points_percent = ($player['action_points'] / 100)*100;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>RPG GAME</title>
    <!-- Bootstrap 5.2 -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- Own Web CSS -->
    <link rel="stylesheet" href="./assets/css/game.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-3 text-center">
            <img src="./upload/avatar/default.png" class="img-thumbnail">
        </div>
        <div class="col-6 text-center">
            <h1>RPG GAME</h1>
            <h4>Witaj w grze <?php echo $player['character_name'];?></h4>
        </div>
        <div class="col-3">
            <div class="card">
                <table class="table table-character text-end">
                    <tbody>
                    <tr>
                        <td>POZIOM</td>
                        <td><?php echo $player['level'];?></td>
                    </tr>
                    <tr>
                        <td>DOŚWIADCZENIE</td>
                        <td><?php echo $player['experience'];?> / <?php echo $player['exp_need_to_levelup'];?></td>
                    </tr>
                    <tr>
                        <td>MONETY</td>
                        <td><?php echo $player['money'];?></td>
                    </tr>
                    <tr>
                        <td>GILDIA</td>
                        <td>%federacja handlowa%</td>
                    </tr>
                    <tr>
                        <td>RANKING</td>
                        <td>%14%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row margin-space_2">
        <div class="col-3 text-center">
            <span>Życie: <?php echo $player['health_current'];?> / <?php echo $player['health_max'];?></span>
            <div class="progress">

                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $health_percent;?>%" aria-valuenow="<?php echo $health_percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span>Punkty akcji: <?php echo $player['action_points'];?> / 100</span>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $action_points_percent;?>%" aria-valuenow="<?php echo $action_points_percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-9 text-center">
            <div class="card">
                <p class="text-center">
Aktualnie wykonywane opracje:
                </p>
                <p class="text-center">
Powiadomienia
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container margin-space_2">
    <div class="row">
        <div class="col-3">
            <?php
            include ("./template/game/sidebar.php");
            ?>
        </div>
        <div class="col-9">

            <div class="game-area">