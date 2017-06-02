<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/Melding.php');
    
    try{    
        if(!empty($_POST) ){
            $melding = new Melding();
            
            $melding->notificationSettings();
            
            $res = $melding->readSettings();
            
            $_SESSION["pushVerkozen"] = $res["push_video"];
            $_SESSION["pushVriendUpload"] = $res["push_upload"];
            $_SESSION["pushProfielStatus"] = $res["push_status"];
            $_SESSION["emailVerkozen"] = $res["mail_video"];
            $_SESSION["emailVriendUpload"] = $res["mail_upload"];
            $_SESSION["emailProfielStatus"] = $res["mail_status"];
            
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

?>