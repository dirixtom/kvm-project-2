<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/Video.php');
    
    try{    
        if(!empty($_POST) ){
            
            $video = new Video;
            $video->checkVote($_POST["video_id"], $_SESSION["userid"]);
            if($video->Voted == false){
            $video->ID = $_POST["video_id"];
            $video->vote($_POST["video_id"], $_SESSION["userid"]);
            } else {
                //niets gebeurt hier.
            }
            
            $video->checkVote($_POST["video_id"], $_SESSION["userid"]);
            
            $feedback = [
                "code" => 200,
                "count" => $video->Votes,
                "boolean" => $video->Voted
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