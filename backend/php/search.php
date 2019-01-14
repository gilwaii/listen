<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";
require_once 'Database.php';

if (isset($_POST['input'])){
    $query = $_POST['input'];
    $min_length = 3;

    $database = new Database();
    $database->connect();

    if(strlen($query) >= $min_length){

        $query = htmlspecialchars($query);

        $query = mysqli_real_escape_string($database->connect(), $query);


        $sql = "SELECT listen.* FROM listen,track
            WHERE listen.id = track.listen_id and ((listen.name LIKE '%".$query."%') OR ( track.lyrics LIKE '%".$query."%'))";

        $res = $database->getAllList($sql);

        $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . "/listen/views/");
        $twig = new Twig_Environment($loader, array(//    'cache' => 'cache',
        ));

        echo $twig->render('result_search.html', array('result' => $res, 'search' => $query));

    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }


}