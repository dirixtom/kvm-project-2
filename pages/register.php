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

	<link href="https://fonts.googleapis.com/css?family=Roboto:200,400,500" rel="stylesheet">

	<style type="text/css">
	   * {
		  margin: 0;
		  padding: 0;
		  font-family: 'Roboto', sans-serif;
		  font-weight: 200;
	   }
	   html {
		  background: #FFF;
	   }
	   body {
		  width: 100vw;
		  height: 100vh;
		  background: Gainsboro;
	   }
	   .container {
		  width: 80%;
		  height: 100%;
		  display: flex;
           justify-content: center !important;
		  overflow-y: visible;
		  margin: auto;
	   }
	   main {
		  width: 360px;
		  height: 500px;
		  background: #FFF;
		  overflow-y: auto;
	   }
	   .scherm {
		  position: relative;
		  background: Gainsboro;
		  height: 640px;
		  width: 360px;
		  margin-top: auto;
		  margin-bottom: auto;
	   }
	   .fill {
		  position: relative;
		  background: Gainsboro;
		  height: 100%;
		  width: 30%;
		  z-index: 500;
	   }
	   .scherm:first-child, .scherm:last-child {
		  z-index: 50000000;
	   }
	   .scherm header {
          position: relative;
          background-color: #E22E2F;
          height: 72px;
          width: 100%;
       }
	   header img {
		   position: absolute;
		   top: 24px;
		   display: block;
		   cursor: pointer;
		   height: 18px;
		   left: 20px;
	   }
	   h1 {
		   position: absolute;
		   color: #FED600;
		   top: 17px;
		   left: 50%;
		   transform: translateX(-50%);
		   font-family: 'Roboto', sans-serif;
		   font-weight: 400;
		   font-size: 23px;
	   }
	   .scherm .sysbar:first-child {
		  width: 100%;
		  margin-bottom: -4px;
		  z-index: 1000;
	   }
	   .scherm .sysbar:not(:first-child) {
		  position: absolute;
		  left: 0;
		  bottom: 0;
		  z-index: 1000;
	   }

	   /* Ripple magic */
	   button {
		  overflow: hidden;
		  z-index: 0;
	   }

	   button:after {
		  content: '';
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  width: 5px;
		  height: 5px;
		  background: rgba(255, 255, 255, .5);
		  opacity: 0;
		  border-radius: 100%;
		  transform: scale(1, 1) translate(-50%);
		  transform-origin: 50% 50%;
	   }

	   @keyframes ripple {
		  0% {
			 transform: scale(0, 0);
			 opacity: 1;
		  }
		  20% {
			 transform: scale(40, 40);
			 opacity: 1;
		  }
		  100% {
			 opacity: 0;
			 transform: scale(100, 100);
		  }
	   }
	   button:focus::after {
		  animation: ripple 1s ease-out;
	   }
		main .form {
			position: relative;
			width: 360px;
			margin-top: 15px;
		}
		main .form input {
			position: relative;
			display: block;
			margin-left: auto;
			margin-right: auto;
			border-top: 0px;
			border-left: 0px;
			border-right: 0px;
			border-bottom: solid 1px color: #95989A;
			outline: none;
			font-weight: lighter;
			font-size: 18px;
			color: #95989A;
			width: 70%;
			height: 40px;
			line-height: 40px;
			margin-bottom: 24px;
 	   }
	   main .form input::-webkit-input-placeholder {
			color: #BEC1C2;
	   }
	   button {
		   position: relative;
		   display: block;
		   margin-left: auto;
		   margin-right: auto;
		   width: 60%;
		   height: 45px;
		   border: none;
		   font-size: 18px;
		   font-weight: 200;
		   border-radius: 30px;
		   background-color: #E22E2F;
		   color: #FED600;
		   outline: none;
	   }
	  .form h4 {
	  	position: relative;
	  	display: block;
	  	width: 100%;
		text-align: center;
	  	font-size: 12px;
	  	color: #E22E2F;
		height: 30px;
		line-height: 30px;
		margin-top: -12px;
		margin-bottom: 8px;
	  }
    </style>
</head>
<body>
	<div class="container">
        <div class="fill">
        </div>
        <div class="scherm">
            <img class="sysbar" src="../images/sysbar-top.png" alt="android systeem balk" />
            <?php include_once("../includes/simpleHeader.php") ?>
            <main>
			      <form action="" method="post" class="form">
			          <input type="text" placeholder="Gebruikersnaam" name="username" id="username">
			          <input type="text" placeholder="Voornaam" name="firstname" id="firstname">
			          <input type="text" placeholder="Naam" name="lastname" id="lastname">
			          <input type="text" placeholder="Email" name="email" id="email">
			          <input type="password" placeholder="Wachtwoord" name="password" id="password">
			          <input type="password" placeholder="Bevestig wachtwoord" name="passwordCheck" id="passwordCheck">
					  <?php if(!empty($error)) : ?>
   					   <h4>
   						   <?php echo $error ?>
   					   </h4>
   				   	  <?php endif ; ?>
			          <button type="submit">Registreren</button>
			      </form>
            </main>
            <img class="sysbar" src="../images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="fill">
        </div>
    </div>
</body>
</html>
