<?php
/**
 * thomsikdev_rpg - file_exist.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 21:54
 * Email: informacje@thomsikdev.pl
 */

//sprawdzamy czy ktoś nie szuka sobie plikow
$files_included = get_included_files();
$searched_file = "game.php";
$files_included_exist_count = 0;
foreach ($files_included as $file_path) {
    if (false !== strpos($file_path, $searched_file)) {
       // var_dump('JEST '.$file_path . " == " . $searched_file . "<br>");
        $files_included_exist_count++;
    }else{
        //var_dump('NIE '.$file_path . " == " . $searched_file . "<br>");
    }

    if($files_included_exist_count <= 0){
        header('Location: /game.php?page=welcome');
    }
}