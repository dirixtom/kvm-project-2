<?php
    define("SCHERM", "Login");

    spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".php");
    });
    
    try{
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
            $user = new User();
            $user->Username = $_POST["username"];
            $user->Password = $_POST["password"];            
            if ($user->canLogin()) {
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
    <a href="#"> Login </a>
    <a href="register.php"> Registreer </a>
    <form action="" method="post">
        <input type="text" placeholder="Gebruikersnaam" name="username" id="username">
        <br>
        <input type="password" placeholder="Wachtwoord" name="password" id="password">
        <br>
        <button type="submit">Aanmelden</button>
    </form>
    <h3> of </h3>
    <button>Log in met Facebook </button>
    <br>
    <a href="#"> wachtwoord vergeten</a>
</body>
</html>