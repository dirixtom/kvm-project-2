<?php
    session_start();

    if (isset($_SESSION['reset'])) {
    } else {
        header('Location: ../index.php');
    }
    
    define("SCHERM", "Reset passwoord");

    spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".php");
    });
    
    try{
        if(!empty($_POST)){
            if(!empty($_POST["password"]) && !empty($_POST["passwordCheck"])){
                $user = new User();
                $user->Password = htmlspecialchars($_POST["password"]);
                $user->PasswordCheck = htmlspecialchars($_POST["passwordCheck"]);
                if ($user->resetPassword()) {
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
   <p>Verzin een nieuw wachtwoord </p>
    <form action="" method="post">
        <input type="password" placeholder="Wachtwoord" name="password" id="password">
        <br>
        <input type="password" placeholder="Bevestig wachtwoord" name="passwordCheck" id="passwordCheck">
        <br>
        <button type="submit">Doorgaan</button>
    </form>
</body>
</html>