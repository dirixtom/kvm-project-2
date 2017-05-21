<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/Melding.php');
    
    try{    
        if(!empty($_POST) ){
            
            $melding = new Melding;
            $melding->deleteMelding($_POST["melding_id"]);
            
            $feedback = [
                "code" => 200,
                "message" => "de notificatie is verwijderd."
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