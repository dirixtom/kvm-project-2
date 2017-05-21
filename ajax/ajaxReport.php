<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/Video.php');
    
    try{    
        if(!empty($_POST) ){
            
            $video = new Video;
            $video->report($_POST["video_id"], $_SESSION["user"], $_POST["category"], $_POST["bericht"]);
            
            
            $feedback = [
                "code" => 200
            ];
                
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        $feedback = [
            "code" => 500,
            "message" => $error
        ];
    }
    
echo json_encode($feedback);