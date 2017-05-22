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
    <style>
        #wachtwoord_modal{
            display: none;
        }
    </style>
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
    <a href="#" id="wachtwoord"> wachtwoord vergeten</a>
    <div class="modal" id="wachtwoord_modal">
       <h2> Wachtwoord vergeten </h2>
       <p>Vul het e-mail adres in waarmee je je geregistreerd hebt.</p>
        <form action="" method="post">
            <input type="text" name="email" id="email" placeholder="E-mail">
            <button id="cancel_wachtwoord"> annuleer </button>
            <button type="submit"> ok </button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>