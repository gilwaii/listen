<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";
require_once 'Database.php';

$database = new Database();

$database->connect();
$lists = $database->getAllList("select * from listen");

$level = $database->getAllList("select level from level_audio");

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/");
$twig = new Twig_Environment($loader, array(
//    'cache' => 'cache',
));

echo $twig->render('audios.html', array('lists'=>$lists,'level'=>$level,'page'=>count($lists)));