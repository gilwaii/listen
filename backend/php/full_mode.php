<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";
require_once 'Database.php';
require_once 'common.php';

if (isset($_POST['id']) && isset($_POST['mode'])) {
    $id = $_POST['id'];
    $mode = $_POST['mode'];
    $database = new Database();

    $database->connect();
    $lists = $database->getAllList("select * from listen where id= '$id'");
    $track = $database->getAllList("select * from track where listen_id= '$id'");

    foreach ($track as $key => $arr){
        foreach ($arr as $k => $value){
            if ($k === 'lyrics'){
                $track[$key][$k] = remove_special_char($value);
            }
        }
    }

    $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/mode");
    $twig = new Twig_Environment($loader, array(//    'cache' => 'cache',
    ));

    $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    if ($mode == "fullMode"){
        echo $twig->render('fullmode.html', array('lists' => $lists,'track' => $track,'id'=>$id,'username'=>$username));
    }else if ($mode == "newMode"){
        echo $twig->render('newmode.html', array('lists' => $lists,'track' => $track,'id'=>$id,'username'=>$username));
    }else if ($mode == "blankMode"){
        echo $twig->render('blankmode.html', array('lists' => $lists,'track' => $track,'id'=>$id,'username'=>$username));
    }else{
        echo $twig->render('quickmode.html', array('lists' => $lists,'track' => $track,'id'=>$id,'username'=>$username));
    }
}
