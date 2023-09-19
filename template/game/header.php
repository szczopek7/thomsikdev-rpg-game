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
            <h4>Witaj w grze %admin%</h4>
        </div>
        <div class="col-3">
            <div class="card">
                <table class="table table-character text-end">
                    <tbody>
                    <tr>
                        <td>POZIOM</td>
                        <td>%15%</td>
                    </tr>
                    <tr>
                        <td>DOŚWIADCZENIE</td>
                        <td>%4214215%</td>
                    </tr>
                    <tr>
                        <td>PIENIADZE</td>
                        <td>%6931%</td>
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
            <span>Życie: %249% / %350%</span>
            <div class="progress">

                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span>Punkty akcji: %100% / %100%</span>
            <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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