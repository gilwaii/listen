<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";
require_once 'Database.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $database = new Database();

    $database->connect();
    $lists = $database->getAllList("select * from listen where id= '$id'");

    $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/");
    $twig = new Twig_Environment($loader, array(//    'cache' => 'cache',
    ));
    echo $twig->render('choose_mode.html', array('lists' => $lists));
}
