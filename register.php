<?php
    define("SCHERM", "Registreer");
    
    spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
    });
    
    try{
        if(!empty($_POST["username"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["passwordCheck"])){
            $user = new User();
            $user->Username = $_POST["username"];
            $user->Firstname = $_POST["firstname"];
            $user->Lastname = $_POST["lastname"];
            $user->Email = $_POST["email"];
            $user->Password = $_POST["password"];
            $user->PasswordCheck = $_POST["passwordCheck"];
            $user->Image = "default.png";
            
            if ($user->register()) {
                $user->handleLogin();
            }
        } else {
            throw new Exception('Niet alle velden zijn ingevuld.');
        }
    } catch (Exception $e){
        
    }
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SCHERM; ?></title>
</head>
<body>
   <a href="login.php"> terug </a>
    <form action="" method="post">
        <input type="text" placeholder="Gebruikersnaam" name="username" id="username">
        <br>
        <input type="text" placeholder="Voornaam" name="firstname" id="firstname">
        <br>
        <input type="text" placeholder="Naam" name="lastname" id="lastname">
        <br>
        <input type="text" placeholder="Email" name="email" id="email">
        <br>
        <input type="password" placeholder="Wachtwoord" name="password" id="password">
        <br>
        <input type="password" placeholder="Bevestig wachtwoord" name="passwordCheck" id="passwordCheck">
        <br>
        <button type="submit">Registreren</button>
    </form>
</body>
</html>