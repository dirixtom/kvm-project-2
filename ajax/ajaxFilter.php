<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/Video.php');
    
    try{    
        if(!empty($_POST) ){
            
            if($_POST["filter"]==1){
                $_SESSION["filter"]="Nieuwste";
            } else if($_POST["filter"]==2){
                $_SESSION["filter"]="Oudste";
            } else if($_POST["filter"]==3){
                $_SESSION["filter"]="Stemmen";
            }
            
            $videos = new Video;
            $videos->printRecent();
                
            $feedback = [
                "code" => 200,
                "message" => "nieuwe filter is ingesteld."
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