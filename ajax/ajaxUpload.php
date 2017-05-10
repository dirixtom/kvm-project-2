<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');
    
    try{    
        if(!empty($_POST) ){
            
            var_dump($_POST);
            echo $_POST["data"];
            
            $feedback = [
                "code" => 200,
                "message" => "AAAAAAAAA"
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