<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/Melding.php');
    
    try{    
        if(!empty($_POST) ){
            
            $melding = new Melding;
            $melding->view();
            
            $feedback = [
                "code" => 200,
                "message" => "de notificaties zijn bekeken."
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