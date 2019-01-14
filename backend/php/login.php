<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";
require_once 'Database.php';
require_once 'common.php';

if (isset($_POST['username']) && isset($_POST['pass'])){
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $remember_me = 'on';

    $username = xss_cleaner($username);
    $pass = xss_cleaner($pass);

    //database
    $db = new Database();
    $db->connect();
    $sql = "SELECT * from user where username = '".mysqli_real_escape_string($db->connect(),$username)."' and password = '".mysqli_real_escape_string($db->connect(),$username)."'";
    $result = $db->getRow($sql);
    if (count($result) >0){
        if ($remember_me == 'on'){
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
        }
        header('Location: http://localhost/listen');
    }else{
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }

    $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/");
    $twig = new Twig_Environment($loader, array(
//    'cache' => 'cache',
    ));
//    header('Location: http://localhost/listen');
    return $twig->render(generateUrl('index.html', array('template' => $loader)));

}