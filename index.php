<?php
/**
 * thomsikdev_rpg - index.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 16.09.2023
 * Time: 03:16
 * Email: informacje@thomsikdev.pl
 */

include ('./template/page/header.php');

if(empty($_GET['page'])){
    $_GET['page'] = "news";
    $activepage = $_GET['page'];
}else{
    $activepage = $_GET['page'];
}


switch ($activepage) {
    case "image_creators":
        $activepage = "image_creators";
        include('page/image_creators.php');
        break;
    case "changelog":
        $activepage = "changelog";
        include('page/changelog.php');
        break;
    default:
        $activepage = "news";
        include('page/news.php');
}


include ("./template/page/footer.php");
?>