<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');
    
    try{    
        if(!empty($_POST) ){
            
            $data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
            $decodedData = base64_decode($data);
            
            /*echo ($decodedData);*/
            $filename = time() . "_". $_SESSION["user"] . $_POST["fname"];
            
            $fp = fopen("../uploads/videos/" . $filename, 'wb');
            fwrite($fp, $decodedData);
            fclose($fp);
            
            $_SESSION["recorded"] = $filename;
            
            $feedback = [
                "code" => 200,
                "message" => "De video has been recorded"
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