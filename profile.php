<?php
    session_start();
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }
    
    define("SCHERM", "Profiel");

    spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
    });

        try{
            $user = new User();
            
        if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"])){
            $user->Firstname = $_POST["firstname"];
            $user->Lastname = $_POST["lastname"];
            $user->Email = $_POST["email"];
        } else {
            throw new Exception('Een veld mag niet leeg zijn!');
        }
        
        if (!empty($_FILES['image']['name'])) {
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
        }
        $user->updateProfile();
        
    } catch (Exception $e){
        
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SCHERM; ?></title>
</head>
<style>
    .image{
        visibility: hidden;
    }
</style>
<body>
   <a href="overview.php"> terug </a>
    <h1> <?php echo $_SESSION['user']; ?></h1>
    <img src="uploads/profileImages/<?php echo $_SESSION['image']; ?>" alt="profielfoto" id="img" style="max-width: 150px;">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" class="image" id="image">
        <button type="submit" class="image">Bevestig</button>
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
    <button>Verbind met Facebook </button>
    <br>
    <a href="#"> verwijder profiel </a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>