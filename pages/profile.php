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
                $linkUrl = $helper->getLoginUrl('https://roelifant.com/fancorder/facebook_login/fb_link_callback.php', $permissions);

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
<link href="https://fonts.googleapis.com/css?family=Roboto:200,400,500" rel="stylesheet">

<style type="text/css">
  * {
     margin: 0;
     padding: 0;
     font-family: 'Roboto', sans-serif;
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
     height: 330px;
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
.scherm #bkgd {
  width: 100%;
  height: calc(230px - 64px);
}
   .scherm #bkgd #background {
     width: 100%;
     height: 230px;
     filter: blur(12px);
     margin-top: -72px;
     z-index: -100;
   }
   .scherm #img {
     position: absolute;
     top: 98px;
     left: 50%;
     transform: translateX(-50%);
     width: 120px;
     height: 120px;
     border-radius: 50%;
   }
  .scherm header {
     position: relative;
     height: 72px;
     width: 100%;
     z-index: 1000;
  }
  .scherm .sysbar:first-child {
     width: 100%;
     margin-bottom: -4px;
     z-index: 100000;
  }
  .scherm .sysbar:not(:first-child) {
     position: absolute;
     left: 0;
     bottom: 0;
     z-index: 1000;
  }
  .hidden {
     visibility: hidden;
  }
  #verwijder {
    position: relative;
    margin-top: 32px;
    margin-left: 20px;
    text-decoration: none;
    color: #95989A;
    font-size: 12px;
  }
      h1 {
          position: absolute;
          color: #FFF;
          top: 17px;
          left: 50%;
          transform: translateX(-50%);
          font-family: 'Roboto', sans-serif;
          font-weight: 400;
          font-size: 23px;
      }
      header img {
          position: absolute;
          top: 24px;
          display: block;
          cursor: pointer;
          height: 18px;
          left: 20px;
      }

  /* Ripple magic */
  #fb-button {
     position: relative;
     display: flex;
     align-items: center;
     justify-content: space-between;
     padding-left: 16px;
     padding-right: 16px;
     margin-left: 20px;
     margin-bottom: 32px;
     width: 60%;
     height: 45px;
     border: none;
     font-size: 14px;
     font-weight: 200;
     border-radius: 30px;
     background-color: #3B5998;
     color: #FFF;
     outline: none;
   }

  #fb-button:after {
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
        transform: scale(25, 25);
        opacity: 1;
     }
     100% {
        opacity: 0;
        transform: scale(40, 40);
     }
  }

  #fb-button:focus::after {
     animation: ripple 1s ease-out;
  }
  nav div {
     position: relative;
     width: 100%;
     height: 48px;
     background-color: #FFF;
     margin-top: 48px;
     display: flex;
     align-items: center;
     justify-content: flex-end;
  }
  .rapporteer {
     margin-right: 16px;
  }
  .video_id{
     display: none;
  }
  #verwijder_modal{
     display: none;
  }
  #report_modal{
     display: none;
  }
  #report_modal select {
     margin-left: 24px;
     margin-top: 16px;
  }
  .emptystate{
     color: #626A6C;
     margin: auto 0;
     text-decoration: none;
     text-align: center;
  }
   .nummer{
       position: absolute;
       left: 335px;
       top: 30px;
   }
   #meldingen{
       position: absolute;
       background-color: white;
       width: 260px;
       left: 50px;
       top: 20px;
       display: none;
   }
   #meldingen ul{
       list-style-type: none;
   }
   #meldingen a{
       text-decoration: none;
   }
   #meldingen .melding_id{
       display: none;
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
         height: 60px;
         line-height: 30px;
         width: 232px;
      }
      .modal input::placeholder{
         font-weight: 200;
         font-size: 14px;
         color: #95989A;
      }
      .modal .buttons {
         position: absolute;
         bottom: 20px;
         right: 0px;
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
  #facebook-logo {
    height: 20px;
  }
  .labelinput {
    margin-left: 20px;
    margin-top: 16px;
  }
  .labelinput:nth-child(4) {
    margin-bottom: 32px;
  }
  #status {
    color: #008000;
    margin-bottom: 32px;
  }
  form label {
    font-weight: lighter;
    font-size: 20px;
    color: #626A6C;
   }
  form input {
    font-weight: lighter;
    font-size: 20px;
    color: #95989A;
    border: none;
    margin-left: 16px;
    text-transform: capitalize;
    max-width: 60%;
   }
   form input:first-child {
     max-width: 50%;
   }
   #email {
     text-transform: lowercase;
   }
</style>
<style>
    #image_modal{
        display: none;
    }
    #verwijder_modal{
        display: none;
    }
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        border: 0px;
        display: inline-block;
        cursor: pointer;
        margin-left: 22px;
        margin-top: 32px;
        font-size: 18px;
    }
    label span {
       margin-left: 10px;
    }
</style>
<body>
    <div class="container">
        <div class="fill">
        </div>
        <div class="scherm">
            <img class="sysbar" src="../images/sysbar-top.png" alt="android systeem balk" />
            <?php include_once("../includes/profileHeader.php") ?>
            <div id="bkgd">
              <img src="../uploads/profileImages/<?php echo $_SESSION['image']; ?>" alt="profielfoto" id="background"> <!-- achtergrond foto -->
            </div>
            <img src="../uploads/profileImages/<?php echo $_SESSION['image']; ?>" alt="profielfoto" id="img"> <!-- profiel foto -->
            <main>
                <?php if(!empty($error)) : ?>
                    <h4>
            	      <?php echo $error ?>
            	     </h4>
            	<?php endif ; ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal" id="image_modal">
                        <h2> Stel een afbeelding in </h2>
                        <p>Kies een afbeelding uit je bestanden.</p>
                        <label class="custom-file-upload">
                            <input type="file" name="image" id="image"/>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" fill="#626A6C" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg><span>Kies een afbeelding&hellip;</span>
                        </label>
                        <div class="buttons">
                          <button id="cancel_img"> ANNULEER </button>
                          <button type="submit"> OK </button>
                        </div>
                    </div>
                    <div class="labelinput">
                      <label class="form" for="firstname"> Voornaam: </label>
                      <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['firstname'];?>">
                    </div>
                    <div class="labelinput">
                      <label for="lastname"> Naam: </label>
                      <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['lastname'];?>">
                    </div>
                    <div class="labelinput">
                      <label for="email"> E-mail: </label>
                      <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'];?>">
                    </div>
                    <div class="labelinput">
                      <label for="status"> Status: </label>
                      <input type="text" name="status" id="status" value="Perfect">
                    </div>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="facebook_link">
                    <button id="fb-button" type="submit"><img id="facebook-logo" src="../images/facebook-logo.svg" alt="facebook logo" /> Verbind met Facebook </button>
                </form>
                <a href="#" id="verwijder"> Verwijder profiel </a>
                <div class="modal" id="verwijder_modal">
                   <h2> Verwijder profiel </h2>
                   <p>Ben je zeker dat je je profiel wil verwijderen? alle gegevens zullen van je toestel gewist worden en kunnen niet meer hersteld worden. </p>
                    <form action="" method="post">
                      <div class="buttons">
                        <button id="cancel_verwijder"> ANNULEER </button>
                        <input type="hidden" value="true" name="delete" id="delete">
                        <button type="submit"> OK </button>
                      </div>
                    </form>
                </div>
            </main>
            <img class="sysbar" src="../images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="fill">
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/profile.js"></script>
</body>
</html>
