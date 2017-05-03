<?php
    //hier komt JSON
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');
    include_once('../profile.php');
    
    try{    
        if(!empty($_POST) ){
            $user = new User();

            if(!empty($_POST['firstname'])){
                $user->Firstname = $_POST['firstname'];
            } else {
                $user->Firstname = $_SESSION['firstname'];
            }

            if(!empty($_POST['lastname'])){
                $user->Lastname = $_POST['lastname'];
            } else {
                $user->Lastname = $_SESSION['lastname'];
            }

            if(!empty($_POST['email'])){
                $conn = Db::getInstance();
                $checkemail = $conn->prepare("SELECT * FROM `users` WHERE (email =:email) and (username != :username)");
                $checkemail->bindValue(":email", $_POST['email']);
                $checkemail->bindValue(":username", $_SESSION['user']);
                $checkemail->execute();
                $found_email = $checkemail->fetch(PDO::FETCH_ASSOC);
                $rows = count($found_email);
                if (($found_email == true)) {
                    throw new Exception("Deze email staat al geregistreerd op een ander account.");
                }
                    $user->Email = $_POST['email'];

            } else {
                $user->Email = $_SESSION['email'];
            }

            if(empty($_FILES['image'])){
                $user->Image = $_SESSION['image'];
            }

            /*if (!empty($_FILES['image']['name'])) {
                $bestandsnaam = strtolower($_FILES['image']['name']);

                if (strpos($bestandsnaam, ".png")) {
                    move_uploaded_file($_FILES["image"]["tmp_name"],
                    "uploads/profileImages/" . $_SESSION['userid'] . ".png");
                    $user->Image = $_SESSION['userid'] . ".png";
                } elseif (strpos($bestandsnaam, ".jpg")) {
                    move_uploaded_file($_FILES["image"]["tmp_name"],
                    "uploads/profileImages/" . $_SESSION['userid'] . ".jpg");
                    $user->Image = $_SESSION['userid'] . ".jpg";
                } elseif (strpos($bestandsnaam, ".gif")) {
                    move_uploaded_file($_FILES["image"]["tmp_name"],
                    "uploads/profileImages/" . $_SESSION['userid'] . ".gif");
                    $user->Image = $_SESSION['userid'] . ".gif";
                } else {
                    throw new exception("De foto moet een jpg, png of gif zijn!");
                }
            } else {
                $user->Image = $_SESSION['image'];
            }*/


            if($user->updateProfile()){
                $feedback = [
                    "code" => 200
                ];
            } else {
                $feedback = [
                    "code" => 500
                ];
            }
            echo json_encode($feedback);
        }
    } catch (Exception $e) {
                    echo $e->getMessage();
    }

?>