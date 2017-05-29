<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');
    
    try{    
        if(!empty($_POST) ){
            
            $user = new User;
            $user->Email= htmlspecialchars($_POST["email"]);
            $user->makeResetKey();
            
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