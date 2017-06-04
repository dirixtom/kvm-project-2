<?php

    if(!session_id()){
        session_start();
    };

    if (isset($_SESSION['user'])) {
        header('Location: ../index.php');
    }

    require_once('../tools/vendor/autoload.php');
    
    define("SCHERM", "Login");

    include_once("../classes/Db.php");
    include_once("../classes/Melding.php");
    include_once("../classes/User.php");


    try{
        if($_POST){
            if(!empty($_POST["username"]) && !empty($_POST["password"])){
                $user = new User();
                $user->Username = htmlspecialchars($_POST["username"]);
                $user->Password = htmlspecialchars($_POST["password"]);
                if ($user->canLogin()) {
                    $user->handleLogin();
                }
            } else if(empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["email"])){
                
                if(isset($_POST["facebook_login"])){
                    facebookLogin();
                } else {
                    throw new Exception('Niet alle velden zijn ingevuld.');
                }
            }
            
        }

    } catch (Exception $e){
		$error= $e->getMessage();
    }

    function facebookLogin(){
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
                $loginUrl = $helper->getLoginUrl('http://localhost/project/kvm-project-2/facebook_login/fb_callback.php', $permissions);
                
                header("Location: ".$loginUrl);
        }
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
		  height: 370px;
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
	   	width: 100%;
		height: 200px;
		background-color: #E22E2F;
		background-image: url("../images/bkgd_foto.jpg");
		background-position: cover;
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
	   button#upload img {
		 width: 20px;
	   }
	   nav {
		  height: 48px;
		  width: 100%;
		  position: absolute;
		  z-index: 1;
	   }
	   nav a {
		  width: calc(50% - 2px);
		  height: 100%;
		  border-right: 2px solid #FED600;
		  background-color: #E22E2F;
		  font-size: 18px;
		  float: left;
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  text-decoration: none;
		  color: #FED600;
	   }
	   nav a:first-child {
		  background-color: #FFF;
		  color: #626A6C;
	   }
	   nav a:last-child {
		  border: none;
		  width: 50%;
	   }
	   .modal {
		  position: absolute;
		  width: 300px;
		  height: 234px;
		  top: 50%;
		  left: 50%;
		  transform: translateY(-50%) translateX(-50%);
		  background-color: #FFF;
		  border-radius: 4px;
		  -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
		  -moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
		  box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
		  z-index: 10000;
	   }
	   .modal h2 {
		  font-family: 'Roboto', sans-serif;
		  font-weight: 200;
		  font-size: 20px;
		  color: #E22E2F;
		  margin-top: 24px;
		  margin-left: 24px;
	   }
	   .modal p {
		  font-family: 'Roboto', sans-serif;
		  font-weight: 200;
		  font-size: 14px;
		  margin-top: 16px;
		  margin-left: 24px;
		  margin-right: 24px;
		  color: #95989A;
	   }
	   .modal input{
		  border-top: 0px;
		  border-left: 0px;
		  border-right: 0px;
		  outline: none;
		  margin-top: 20px;
		  margin-left: 24px;
		  font-weight: 200;
		  font-size: 14px;
		  color: #95989A;
		  line-height: 30px;
		  width: 232px;
	   }
	   .modal .buttons {
		  position: absolute;
		  bottom: -48px;
		  right: -24px;
	   }
	   .modal button {
		  position: relative;
		  font-weight: 200;
		  font-size: 14px;
		  color: #OOO;
		  background-color: #FFF;
		  width: 80px;
		  height: 30px;
		  border: none;
		  outline: none;
		  cursor: pointer;
	   }
	   .modal button:first-child {
		  color: #E22E2F;

	   }
        #wachtwoord_modal {
            display: none;
        }
        #key_modal {
            display: none;
        }
		main .form {
			position: relative;
			margin-top: 68px;
			width: 360px;
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
	   #divider {
	   	height: 40px;
		display: flex;
		align-items: center;
		justify-content: space-between;
	   }
	   #divider hr {
	   	width: 40%;
		color: #95989A;
	   }
	   #divider h3 {
	   	color: #95989A;
	   }
	   #wachtwoord {
		position: absolute;
		bottom: 56px;
		left: 50%;
		transform: translateX(-50%);
		display: block;
		margin-left: auto;
		margin-right: auto;
		color: #95989A;
		text-decoration: none;
		font-size: 12px;
	  }
	  .form h4 {
	  	position: relative;
	  	display: block;
	  	width: 100%;
		text-align: center;
	  	font-size: 12px;
	  	color: #E22E2F;
		margin-top: -16px;
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

			<header></header>

			<div class="modal" id="wachtwoord_modal">
		       <h2> Wachtwoord vergeten </h2>
		       <p>Vul het e-mail adres in waarmee je je geregistreerd hebt.</p>
		        <form action="" method="post" class="form">
		            <input type="text" name="email" id="email" placeholder="E-mail">
		            <button id="cancel_wachtwoord"> annuleer </button>
		            <button id="key" type="submit"> ok </button>
		        </form>
		    </div>
            
            <div class="modal" id="key_modal">
		       <h2> Email verstuurd </h2>
		       <p>Een email met een geheime code is naar je adres gestuurd. Vul de code hier in.</p>
		        <form action="" method="post" class="form">
		            <input type="text" name="code" id="code" placeholder="typ de code hier.">
		            <button id="cancel_wachtwoord"> annuleer </button>
		            <button id="reset" type="submit"> ok </button>
		        </form>
		    </div>

            <main>
               <nav>
				   <a href="#"> Login </a>
				   <a href="register.php"> Registreer </a>
               </nav>
			   <form action="" method="post" class="form">
		           <input type="text" placeholder="Gebruikersnaam" name="username" id="username">
		           <input type="password" placeholder="Wachtwoord" name="password" id="password">
				   <?php if(!empty($error)) : ?>
					   <h4>
						   <?php echo $error ?>
					   </h4>
				   <?php endif ; ?>
		           <button type="submit">Aanmelden</button>
		       </form>
			   <div id="divider">
				   <hr><h3>of</h3><hr>
			   </div>
                
                <form action="" method="post">
                <input type="hidden" name="facebook_login">
		       <button type="submit">Log in met Facebook </button>
		       </form>
		       <a href="#" id="wachtwoord"> Wachtwoord vergeten?</a>
            </main>
            <img class="sysbar" src="../images/navbar-bot.png" alt="android navigatie balk" />
        </div>
		<div class="fill">
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>