<?php
session_start();
require_once 'Database.php';

if (isset($_SESSION['id']) && isset($_POST['level'])){
    $id = $_SESSION['id'];
    $level = $_POST['level'];
    $db = new Database();

    $res = $db->getAllList("SELECT number,point FROM chart WHERE user_id='$id' AND level = '$level'");
    echo json_encode($res);

}