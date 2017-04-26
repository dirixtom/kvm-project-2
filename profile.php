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
        if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"])){
            $user = new User();
            $user->Firstname = $_POST["firstname"];
            $user->Lastname = $_POST["lastname"];
            $user->Email = $_POST["email"]; 
            if ($user->updateProfile()) {
                //header('Location: profile.php');
            }
        } else {
            throw new Exception('Een veld mag niet leeg zijn!');
        }
    } catch (Exception $e){
        
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SCHERM; ?></title>
</head>
<style>
    .nodisplay{
        visibility: hidden;
    }
</style>
<body>
   <a href="overview.php"> terug </a>
    <h1> <?php echo $_SESSION['user']; ?></h1>
    <img src="uploads/profileImages/<?php echo $_SESSION['image']; ?>" alt="" id="img">
    <form action="" method="post">
        <input type="file" name="image" id="image" class="nodisplay">
        <br>
        <label for="firstname"> Voornaam : </label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['firstname'];?>">
        <br>
        <label for="lastname"> Naam : </label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['lastname'];?>">
        <br>
        <label for="email"> E-mail : </label>
        <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'];?>">
        <button type="submit">update</button>
    </form>
    <button>Verbind met Facebook </button>
    <br>
    <a href="#"> verwijder profiel </a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/profile.js"></script>
</body>
</html>