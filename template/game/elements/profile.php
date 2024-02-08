

<div class="post">

    <h3 class="text-start"><?php echo $name_of_page;?></h3>

    <div class="row">
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end"><h6>Witaj,</h6></li>
                <li class="list-group-item list-group-item-secondary text-center"><h5><?php echo $player['character_name'];?></h5></li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark text-end"><h6>Znajduje się obecnie w mieście</h6></li>
                <li class="list-group-item list-group-item-secondary text-center"><h5><?php echo $player['city'];?></h5></li>
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
                <li class="list-group-item list-group-item-dark text"> <?php echo $player['level'];?></li>
            </ul>
        </div>

        <div class="col-8">
            <p class="text-center">Doświadczenie: <?php echo $player['experience'];?> / <?php echo $player['exp_need_to_levelup'];?> </p>
            <div class="progress">
                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $exp_need_to_levelup_percent;?>%" aria-valuenow="<?php echo $exp_need_to_levelup_percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-2">
            <ul class="list-group">
                <!-- player stats name-->
                <li class="list-group-item list-group-item-dark text-end">Siła:</li>
                <li class="list-group-item list-group-item-secondary text-end">Zręczność: </li>
                <li class="list-group-item list-group-item-dark text-end">Charyzma:</li>
                <li class="list-group-item list-group-item-secondary text-end">Żywotność:</li>
                <li class="list-group-item list-group-item-dark text-end">Inteligencja:</li>
            </ul>
        </div>

        <div class="col-2">
            <ul class="list-group">
                <!-- player stats value-->
                <li class="list-group-item list-group-item-dark"><u><?php echo $player['strength'];?></u></li>
                <li class="list-group-item list-group-item-secondary"><u><?php echo $player['charisma'];?></u></li>
                <li class="list-group-item list-group-item-dark"><u><?php echo $player['dexterity'];?></u></li>
                <li class="list-group-item list-group-item-secondary"><u><?php echo $player['vitality'];?></u></li>
                <li class="list-group-item list-group-item-dark"><u><?php echo $player['intelligence'];?></u></li>
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