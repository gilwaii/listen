<?php
session_start();
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT'] . "/listen/vendor/Twig2/autoload.php";

$loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] .'/listen/views/');
$twig = new Twig_Environment($loader, array(
//    'cache' => 'cache',
));
require_once 'Database.php';
require_once 'mp3file.php';

$database = new Database();
$id = isset($_SESSION['id'])?$_SESSION['id']:'';
$username = isset($_SESSION['username'])?$_SESSION['username']:'';

if(isset($_FILES['datafile']) && isset($_POST['name']) && isset($_POST['level']) && isset($_POST['insert_rows'])) {
    $errors = array();
    $file_name = $_FILES['datafile']['name'];
    $file_size = $_FILES['datafile']['size'];
    $file_tmp = $_FILES['datafile']['tmp_name'];
    $file_type = $_FILES['datafile']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['datafile']['name'])));

//    echo $file_ext, $file_name, $file_size, $file_tmp, $file_type;
    $expensions = array("mp3");

    if (in_array($file_ext, $expensions) === false) {
        $errors = "Please choose a mp3 file.";
    }

    if ($file_size > 20971520) {
        $errors = 'File size must be excately 20 MB';
    }

    if (empty($errors) == true) {
        $path = '/listen/src/mp3/' . basename( $_FILES["datafile"]["name"]);
        $target_path = $_SERVER['DOCUMENT_ROOT'] . $path;
        $ab = @move_uploaded_file($file_tmp, $target_path);
        echo $ab;

        $mp3file = new MP3File($target_path);
        $duration1 = $mp3file->getDurationEstimate();
        $duration2 = $mp3file->getDuration();
//        echo "duration: $duration1 seconds"."\n";
//        echo "estimate: $duration2 seconds"."\n";
//        echo MP3File::formatTime($duration2)."\n";

        $insert_rows = $_POST['insert_rows'];
        $duration_post = 0;
        for($i =0;$i<intval($insert_rows);$i++){
            if(isset($_POST['duration_'.($i+1)]) && isset($_POST['start_'.($i+1)]) && isset($_POST['end_'.($i+1)]) && isset($_POST['lyrics_'.($i+1)])) {
                    $duration_post += intval($_POST['duration_'.($i+1)]);
            }else{
                echo $twig->render('upload.html', array('id' => $id, 'username' => $username, 'error'=>"Error Track"));
            }
        }

//        if($duration_post > $duration1){
//            echo $twig->render('upload.html', array('id' => $id, 'username' => $username, 'error'=>"Error ToTal duration"));
//        }else{
            date_default_timezone_set('Asia/ho_chi_minh');
            $create_at = date("Y-m-d H:i:s");
            $data_listen = ["name"=>$_POST['name'],"path"=>$path,
                            "level_audio"=>$_POST['level'],"file_id"=>1,
                            "category_id"=>1,"create_at"=>$create_at];
            $database->InsertDatabase('listen',$data_listen);
            $listen_id = mysqli_insert_id($database->conn);

            for($i =0;$i<intval($insert_rows);$i++){
                if(isset($_POST['duration_'.($i+1)]) && isset($_POST['start_'.($i+1)]) && isset($_POST['end_'.($i+1)]) && isset($_POST['lyrics_'.($i+1)])) {
                    $data_track = ["name"=>"track-".($i+1),"duration"=>$_POST['duration_'.($i+1)],
                                   "start"=>$_POST['start_'.($i+1)],"end"=>$_POST['end_'.($i+1)],
                                   "listen_id"=> $listen_id, "sequence"=>($i+1),"point"=>100];
                    $database->InsertDatabase('track',$data_track);
                }else{
                    echo $twig->render('upload.html', array('id' => $id, 'username' => $username, 'error'=>"Insert Track"));
                }
            }

//        }
    } else {
        echo $twig->render('upload.html', array('id' => $id, 'username' => $username, 'error'=>$errors));
    }
}else{
    echo $twig->render('upload.html', array('id' => $id, 'username' => $username));
}