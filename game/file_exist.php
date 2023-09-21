<?php
/**
 * thomsikdev_rpg - file_exist.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 17.09.2023
 * Time: 21:54
 * Email: informacje@thomsikdev.pl
 */

//Sprawdza, czy dany plik istnieje
/*
 * Wszystkie operacje mają przechodzić przez plik game.php,
 * jeśli ktoś czegoś szuka w innym, miejscu to automatycznie ma go przekierować
*/

//Pobierze dołączone pliki
//funkcja get_included_files zwraca tablice
$files_included = get_included_files();

//Plik, którego szukam
$searched_file = "game.php";

//Zmienna licząca ilość znalezionych plików
$files_included_exist_count = 0;

//pętla
foreach ($files_included as $file_path) {
    //jeśli znaleziono dany plik dodaj + 1 do zmiennej $files_included_exist_count
    if (false !== strpos($file_path, $searched_file)) {
        $files_included_exist_count++;
    }
}

//jeśli nie znaleziono pliku
if($files_included_exist_count <= 0){
    header('Location: /game.php?page=welcome');
}