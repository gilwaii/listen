<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";
require_once 'Database.php';
require_once 'common.php';

if (isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['repeat-pass'])){
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $repeat_pass = $_POST['repeat-pass'];

    $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/");
    $twig = new Twig_Environment($loader, array(
    //    'cache' => 'cache',
    ));

    if ($pass != $repeat_pass){
        header('Location: http://localhost/listen/views/login/signup.html');
    }else{
        $username = xss_cleaner($username);
        $pass = xss_cleaner($pass);

        $data = ["username"=>$username,"password"=>$pass];
        //database
        $db = new Database();
        $db->connect();
        $result = $db->InsertDatabase('user',$data);

        if ($result){
            $_SESSION['id'] = $username;
            $_SESSION['username'] = $username;
            header('Location: http://localhost/listen');
        }else{
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }

    }
}