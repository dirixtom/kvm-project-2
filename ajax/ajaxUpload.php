<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');
    include_once('../classes/Video.php');
    
    try{    
        if(!empty($_POST) ){
            $video = new Video;

            //id wordt toegevoegd in database
            $video->Data = $_SESSION["recorded"];
            //Tumbnail?
            $video->Uploader = $_SESSION["user"];
            $video->Votes = 0;
            $video->Status = "default";

            $video->upload();
            $video->setTags($_POST["tags"]);
            
            unset($_SESSION['recorded']);
            
            $feedback = [
                "code" => 200,
                "message" => "De video has been saved"
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

?>
