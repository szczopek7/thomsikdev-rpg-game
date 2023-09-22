<?php
require ('app/system.php');
require ('app/user_login_check.php');
//wymagaj pliku player
require ('app/player.php');

// Nagłówek strony
include('template/game/header.php');


if(empty($_GET['page'])){
    $_GET['page'] = "welcome";
    $activepage = $_GET['page'];
}else{
    $activepage = $_GET['page'];
}


switch ($activepage) {
    case "city":
        $activepage = "city";
        include('game/city.php');
        break;
    case "profile":
        $activepage = "profile";
        include('game/profile.php');
        break;
    case "expedition":
        $activepage = "expedition";
        include('game/expedition.php');
        break;
    case "shop":
        $activepage = "shop";
        include('game/shop.php');
        break;
    case "work":
        $activepage = "work";
        include('game/work.php');
        break;
    default:
        $activepage = "homepage";
        include('game/welcome.php');
}


// Stopka strony
include('template/game/footer.php');
?>