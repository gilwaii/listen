<?php
session_start();
require_once 'vendor/Twig2/autoload.php';
require_once 'backend/php/Database.php';

$loader = new Twig_Loader_Filesystem('views/');
$twig = new Twig_Environment($loader, array(//    'cache' => 'cache',
));

$id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

$request = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '';
$database = new Database();
$database->connect();

switch ($request) {
    case '' :
        $res = $database->getAllList("SELECT * FROM listen WHERE file_id = 2");
        $audios = $database->getAllList("SELECT * FROM listen WHERE file_id = 1 LIMIT 6");
        echo $twig->render('index.html', array('lang' => $lang, 'videos' => $res, 'audios' => $audios, 'id' => $id, 'username' => $username));
        break;
    case '/listen/home':
        $res = $database->getAllList("SELECT * FROM listen WHERE file_id = 2");
        $audios = $database->getAllList("SELECT * FROM listen WHERE file_id = 1 LIMIT 6");
        echo $twig->render('index.html', array('lang' => $lang, 'audios' => $audios, 'videos' => $res, 'id' => $id, 'username' => $username));
        break;
    case '/listen/upload/':
        echo $twig->render('upload.html', array('lang' => $lang, 'id' => $id, 'username' => $username));
        break;
    case '/listen/youtube':
        $res = $database->getAllList("SELECT * FROM listen WHERE file_id = 2");
        echo $twig->render('youtube.html', array('lang' => $lang, 'videos' => $res, 'id' => $id, 'username' => $username));
        break;
    case '/listen/audios':
        $lists = $database->getAllList("select * from listen WHERE file_id = 1");

        $level = $database->getAllList("select level from level_audio");

        $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/");
        $twig = new Twig_Environment($loader, array());
        echo $twig->render('audios.html', array('lang' => $lang, 'id' => $id, 'username' => $username, 'lists' => $lists, 'level' => $level, 'page' => count($lists)));
        break;
    case '/listen/choose-mode':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id != '') {
            $lists = $database->getAllList("select * from listen where id= '$id'");

            $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/");
            $twig = new Twig_Environment($loader, array(//    'cache' => 'cache',
            ));
            echo $twig->render('choose_mode.html', array('lang' => $lang, 'id' => $id, 'username' => $username, 'lists' => $lists));
        }

        break;
    case '/listen/my-score':
        if ($username) {
            $lists = $database->getRow("select point from user where id= '$id'");
            echo $twig->render('my-score.html', array('lang' => $lang, 'id' => $id, 'username' => $username, 'user' => $lists));
        }
        break;
    case '/listen/my-account':
        if ($username) {
            echo $twig->render('my-account.html', array('lang' => $lang, 'id' => $id, 'username' => $username));
        }
        break;
    default:
        require __DIR__ . '/views/404.html';
        break;
}