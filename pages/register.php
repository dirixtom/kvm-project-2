<?php
    session_start();

    define("SCHERM", "Registreer");
    
    spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".php");
    });
    
    try{
        if(!empty($_POST)){
        if(!empty($_POST["username"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["passwordCheck"])){
            $user = new User();
            $user->Username = htmlspecialchars($_POST["username"]);
            $user->Firstname = htmlspecialchars($_POST["firstname"]);
            $user->Lastname = htmlspecialchars($_POST["lastname"]);
            $user->Email = htmlspecialchars($_POST["email"]);
            $user->Password = htmlspecialchars($_POST["password"]);
            $user->PasswordCheck = htmlspecialchars($_POST["passwordCheck"]);
            $user->Image = "default.png";
            
            if ($user->register()) {
                $user->handleLogin();
            }
        } else {
            throw new Exception('Niet alle velden zijn ingevuld.');
        }
        }
    } catch (Exception $e){
        $error= $e->getMessage();
    }
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SCHERM; ?></title>
</head>
<body>
  <?php if(isset($error)){echo $error;}; ?>
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