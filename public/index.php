<?php
/**
 * thomsikdev_rpg - index.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 23.10.2023
 * Time: 22:41
 * Email: informacje@thomsikdev.pl
 */
/*
 * Start sesji jeśli sesja nie istnieje
 */
if(session_status() === PHP_SESSION_NONE) session_start();

//Ustawienie katalogu bazowego
const BASEDIR = "/volume1/web/thomsikdev_rpg";

/*
 * @var DEVMODE
 * true : tryb deweloperski aktywny
 * false : tryb dwelopeski nieaktywny
 */
const DEVMODE = true;

//załaduj pliki composera
require(BASEDIR . '/vendor/autoload.php');

//env load
$dotenv = Dotenv\Dotenv::createImmutable(BASEDIR);
$dotenv->Load();

//zmienne dev
if(DEVMODE === true){
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_STRICT);
}else{
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
    mysqli_report(MYSQLI_REPORT_OFF);
}
//dołącz połączenie z DB
require(BASEDIR . '/app/database.php');

function show_error($e): string
{
    $msg = 'Coś poszło nie tak, spróbuj później <br>';
    if(DEVMODE === true){
        $msg .= $e;
    }

    $db_connect->query("INSERT INTO system_logs (tag,log) VALUES ('mysql_error', '$e')");

    return $msg;
}

//załaduj funkcje związane z sesją
require(BASEDIR . '/func/session.php');

//deklaracja podstawowych zmiennych
$errormsg = '';
$infomsg = '';

if(empty($_SESSION['flash_message'])){
    $_SESSION['flash_message'] = "Brak";
}

//sprawdzamy czy jest zalogowany, jeśli tak
if(get_session("thomsikdevlocal") === true){
    //star bufora
    ob_start();

    //weryfikacja czy gracz jest zalogowany
    require_once(BASEDIR . '/app/is_logged.php');
    //główny plik gry
    require_once(BASEDIR . '/app/game.php');
    //góra strony
    require_once(BASEDIR . '/template/game/header.php');

    //filtrujemy pobrany get
    $_GET['game'] = filter_input(INPUT_GET, 'game', FILTER_SANITIZE_SPECIAL_CHARS);

    //jesli nie wybrano strony, przeniesie na główną stronę
    if(empty($_GET['game'])){
        $_GET['game'] = "welcome";
    }
    $activePageGame = $_GET['game'];

    //zakres stron
    $arrayOfPagesGame = ['logout','city','admin','profile','expedition','welcome','work','map'];
    //aktualna strona, sprawdzamy czy istnieje
    $currentPageGame = in_array($activePageGame, $arrayOfPagesGame, true);

    //jeśli tak załaduj ją, jeśli nie przenieś do domyślnej
    if($currentPageGame){
        require_once (BASEDIR . '/game/'.$activePageGame.'.php');
    }else{
        include(BASEDIR . '/game/welcome.php');
    }

    //załaduj stopkę
    require_once(BASEDIR . '/template/game/footer.php');

    //wyłącz bufor
    ob_end_flush();

}

if(get_session("thomsikdevlocal") !== true){
    //star bufora
    ob_start();

    //załaduj góre strony
    require_once(BASEDIR . '/template/page/header.php');

    //filtrujemy pobrany get
    $_GET['page'] = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);

    //jesli nie wybrano strony, przeniesie na główną stronę
    if(empty($_GET['page'])){
        $_GET['page'] = "news";
    }
    $activePageSite = $_GET['page'];

    //zakres stron
    $arrayOfPagesSite = ['news','login','image_creators','changelog','register'];

    //aktualna strona, sprawdzamy czy istnieje
    $currentPageSite = in_array($activePageSite, $arrayOfPagesSite, true);

    //jeśli tak załaduj ją, jeśli nie przenieś do domyślnej
    if($currentPageSite){
        include (BASEDIR . '/pages/'.$activePageSite.'.php');
    }else{
        include(BASEDIR . '/pages/news.php');
    }

    require_once(BASEDIR . '/template/page/footer.php');

    ob_end_flush();
}

