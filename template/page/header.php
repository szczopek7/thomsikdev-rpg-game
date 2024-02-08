<?php
/**
 * thomsikdev_rpg - header.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 16.09.2023
 * Time: 03:12
 * Email: informacje@thomsikdev.pl
 */
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>RPG GAME</title>
    <!-- Bootstrap 5.2 -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Own Web CSS -->
    <link rel="stylesheet" href="/assets/css/web.css">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- header -->
<div class="container">
    <div class="row">
        <!-- logo box -->
        <div class="col-12">
            <h1>RPG GAME</h1>
        </div>
    </div>
</div>

<!-- Navbar -->
<div class="container margin-space_2">
    <div class="row">
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid text-center">
                <a class="navbar-brand" href="#">RPG GAME</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/index.php">Strona główna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/index.php?page=login">Zagraj</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">O grze</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Aktualności</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ranking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=changelog">Ostanie aktualizacje</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- main content container -->
<div class="container margin-space_2">
    <div class="row">
        <div class="col-lg-9">
