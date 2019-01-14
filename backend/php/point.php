<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";
require_once 'Database.php';
require_once 'common.php';

if (isset($_POST['point']) && isset($_POST['level'])) {
    $id = isset($_SESSION['id'])?$_SESSION['id']:'';
    $point = isset($_POST['point'])?$_POST['point']:'';
    $level = isset($_POST['level'])?$_POST['level']:0;

    $database = new Database();

    $database->connect();
    $lists = $database->getRow("select point from user where id= '$id'");
    $point = $point + intval($lists['point']);
    $data['point'] = $point;
    $database->UpdateDatabase('user',$data,'id='.$id.'');

//    insert chart
    if ($level >= 0){
        $number = $database->getRow("select count(number) as num from chart where user_id= '$id'");
        $number_count = intval($number['num']) +1;
        $d['user_id'] = $id;
        $d['level'] = $level;
        $d['number'] = $number_count;
        $d['point'] = $point;
        $database->InsertDatabase('chart',$d);

    }
}

