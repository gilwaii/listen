<?php
session_start();

if (isset($_POST['lang'])){
    $lang = isset($_POST['lang'])?$_POST['lang']:'';
    $_SESSION['lang'] = $lang;
}