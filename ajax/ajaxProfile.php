<?php
    session_start();
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');
    
    try{    
        if(!empty($_POST) ){
            $user = new User();

            if(!empty($_POST['firstname'])){
                $user->Firstname = htmlspecialchars($_POST['firstname']);
            } else {
                $user->Firstname = $_SESSION['firstname'];
            }

            if(!empty($_POST['lastname'])){
                $user->Lastname = htmlspecialchars($_POST['lastname']);
            } else {
                $user->Lastname = $_SESSION['lastname'];
            }

            if(!empty($_POST['email'])){
                $user->Email = htmlspecialchars($_POST['email']);
            } else {
                $user->Email = $_SESSION['email'];
            }

            if(empty($_FILES['image'])){
                $user->Image = $_SESSION['image'];
            }
            
            $user->updateProfile();
            
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