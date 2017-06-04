<?php
    session_start();

    require_once('../facebook_sdk/autoload.php');

    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }
    
    define("SCHERM", "Profiel");

    spl_autoload_register(function ($class) {
        include_once("../classes/" . $class . ".php");
    });

        try{
            if(!empty($_POST)){
            
            if(isset($_POST["facebook_link"])){
                facebookLink();
            }
            
            $user = new User();
        
            if(!empty($_POST["delete"])){
                $user->deleteProfile();
                header ("Location: logout.php");
            }

            if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"])){
                $user->Firstname = htmlspecialchars($_POST["firstname"]);
                $user->Lastname = htmlspecialchars($_POST["lastname"]);
                $user->Email = htmlspecialchars($_POST["email"]);
            } else {
                throw new Exception('Een veld mag niet leeg zijn!');
            }

            if (!empty($_FILES['image']['name'])) {
                $bestandsnaam = strtolower($_FILES['image']['name']);

                if (strpos($bestandsnaam, ".png")) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/profileImages/" . $_SESSION['userid'] . ".png");
                    $user->Image = $_SESSION['userid'] . ".png";
                } elseif (strpos($bestandsnaam, ".jpg")) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/profileImages/" . $_SESSION['userid'] . ".jpg");
                    $user->Image = $_SESSION['userid'] . ".jpg";
                } elseif (strpos($bestandsnaam, ".gif")) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/profileImages/" . $_SESSION['userid'] . ".gif");
                    $user->Image = $_SESSION['userid'] . ".gif";
                } else {
                    throw new exception("De foto moet een jpg, png of gif zijn!");
                }
            } else {
                $user->Image = $_SESSION['image'];
            }
        $user->updateProfile();
            }
    } catch (Exception $e){
        $error= $e->getMessage();
    }

function facebookLink(){
        $facebook = new \Facebook\Facebook([
          'app_id' => '733296620185263',
          'app_secret' => 'f83117d28e549655075c13906449915a',
          'default_graph_version' => 'v2.9',
          //'default_access_token' => '{access-token}', // optional
        ]);
        
        //$user = $facebook->facebook->getUser();
        
        if(!isset($_SESSION['fb_access_token'])){
                //$user = null;
                //User is not logged in
                
                $helper = $facebook->getRedirectLoginHelper();

                $permissions = ['email', 'public_profile']; // Optional permissions
                $linkUrl = $helper->getLoginUrl('http://localhost/project/kvm-project-2/facebook_login/fb_link_callback.php', $permissions);
                
                header("Location: ".$linkUrl);
        } else {
            throw new exception("Dit account is al gelinkt met facebook.");
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SCHERM; ?></title>
</head>
<style>
    #image_modal{
        display: none;
    }
    #verwijder_modal{
        display: none;
    }
</style>
<body>
   <a href="../index.php"> terug </a>
    <h1> <?php echo $_SESSION['user']; ?></h1>
    <img src="../uploads/profileImages/<?php echo $_SESSION['image']; ?>" alt="profielfoto" id="img" style="max-width: 150px;"> <!-- profiel foto -->
    <img src="../uploads/profileImages/<?php echo $_SESSION['image']; ?>" alt="profielfoto" id="background" style="max-width: 150px;"> <!-- achtergrond foto -->
    <?php if(!empty($error)) : ?>
        <h4>
	      <?php echo $error ?>
	     </h4>
	<?php endif ; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal" id="image_modal">
            <h2> Stel een afbeelding in </h2>
           <p>Kies een afbeelding uit je bestanden.</p>
            <input type="file" name="image" id="image">
            <button id="cancel_img"> annuleer </button>
            <button type="submit"> ok </button>
        </div>
        <br>
        <label for="firstname"> Voornaam : </label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['firstname'];?>">
        <br>
        <label for="lastname"> Naam : </label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['lastname'];?>">
        <br>
        <label for="email"> E-mail : </label>
        <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'];?>">
    </form>
    <form action="" method="post">
        <input type="hidden" name="facebook_link">
        <button type="submit">Verbind met Facebook </button>
    </form>
    <br>
    <a href="#" id="verwijder"> verwijder profiel </a>
    <div class="modal" id="verwijder_modal">
       <h2> Verwijder profiel </h2>
       <p>Ben je zeker dat je je profiel wil verwijderen? alle gegevens zullen van je toestel gewist worden en kunnen niet meer hersteld worden. </p>
        <form action="" method="post">
            <button id="cancel_verwijder"> annuleer </button>
            <input type="hidden" value="true" name="delete" id="delete">
            <button type="submit"> ok </button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/profile.js"></script>
</body>
</html>