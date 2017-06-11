<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: pages/login.php');
    }

    define("SCHERM", "Overzicht");

    spl_autoload_register(function ($class) {
        include_once("classes/" . $class . ".php");
    });

    $videos = new Video;
    $res = $videos->printRecent();
    $videos->feature();

    $melding = new Melding;
    $melding->notifyFeatured();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo SCHERM; ?></title>

	<script src="js/jquery.min.js"></script>
	<script src="js/overview.js"></script>
	<script src="js/desktopNotifications.js"></script>
	<script src="js/hotkeys.js"></script>

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
         height: 496px;
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
      .menu {
         position: absolute;
         display: block;
         background-color: #888;
         width: 300px;
         height: 600px;
         left: -300px;
         -webkit-transition-duration: .2s;
         -moz-transition-duration: .2s;
         -ms-transition-duration: .2s;
         -o-transition-duration: .2s;
         transition-duration: .2s;
         -webkit-transition-delay: .2s;
         -moz-transition-delay: .2s;
         -ms-transition-delay: .2s;
         -o-transition-delay: .2s;
         transition-delay: .2s;
         z-index: 3;
      }
      .shade {
         position: absolute;
         display: block;
         background-color: #000;
         opacity: 0.4;
         visibility: hidden;
         width: 360px;
         height: 600px;
         -webkit-transition-duration: .2s;
         -moz-transition-duration: .2s;
         -ms-transition-duration: .2s;
         -o-transition-duration: .2s;
         transition-duration: .2s;
         -webkit-transition-delay: .2s;
         -moz-transition-delay: .2s;
         -ms-transition-delay: .2s;
         -o-transition-delay: .2s;
         transition-delay: .2s;
         z-index: 2;
      }
      .menuicon {
         position: absolute;
         top: 23px;
         left: 20px;
         display: inline-block;
         cursor: pointer;
         height: 12px;
         width: 22px;
      }
      span {
         display: block;
         top: 8px;
         width: 22px;
         height: 3px;
         background-color: #FED600;
         position: relative;
      }
      span::after, span::before {
         display: block;
         content: '';
         position: absolute;
         width: 22px;
         height: 3px;
         background-color: #FED600;
      }
      span::before {
         margin-top: -6.5px;
      }
      span::after {
         margin-top: 6.5px;
      }
      .menuicon:hover ~ .menu, .menu:hover, .menuicon:active ~ .menu{
         left: 0px;
      }
      .menuicon:hover ~ .shade, .menu:hover ~ .shade{
         visibility: visible;
      }
      .hidden {
         visibility: hidden;
      }
      h1 {
         position: absolute;
         color: #FED600;
         top: 19px;
         left: 65px;
         font-family: 'Roboto', sans-serif;
         font-weight: lighter;
         font-size: 23px;
      }
      header img {
         position: absolute;
         top: 20px;
         display: block;
         cursor: pointer;
         height: 24px;
      }
      header img#twee {
         height: 22px;
         top: 21px;
         right: 70px;
      }
      header img#drie {
         right: 20px;
      }
      button#upload {
         width: 56px;
         height: 56px;
         position: absolute;
         display: flex;
         align-items: center;
         justify-content: center;
         background-color: #E22E2F;
         border: none;
         outline: none;
         border-radius: 50%;
         -webkit-box-shadow: 2px 2px 2px 0px rgba(0,0,0,0.25);
         -moz-box-shadow: 2px 2px 2px 0px rgba(0,0,0,0.25);
         box-shadow: 2px 2px 2px 0px rgba(0,0,0,0.25);
      }

      /* Ripple magic */
      button{
         position: absolute;
         overflow: hidden;
         bottom: 68px;
         right: 24px;
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
            transform: scale(25, 25);
            opacity: 1;
         }
         100% {
            opacity: 0;
            transform: scale(40, 40);
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
         width: calc(25% - 2px);
         height: 100%;
         border-right: 2px solid #FFF;
         background-color: #626A6C;
         float: left;
         display: flex;
         align-items: center;
         justify-content: center;
         text-decoration: none;
         color: #FFF;
      }
      nav a:first-child {
         background-color: #FFF;
         color: #626A6C;
      }
      #last-child {
         border: none;
         width: 25%;
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
      #filter {
         width: 20px;
         margin-right: 24px;
      }
      #videocontainer {
         position: relative;
         margin-top: 96px;
      }
      .video {
         position: relative;
         width: 94%;
         height: 200px;
         margin: 0 auto;
         clear: both;
         margin-bottom: 12px;
         border-radius: 4px;
         -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
         -moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
         box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
      }
      .video .imgcontainer {
         width: 100%;
         height: calc(100% - 40px);
         overflow: hidden;
      }
      .video video {
         width: 100%;
         border-radius: 4px;
      }
      .video .actionbar {
         height: 40px;
         width: 100%;
         position: absolute;
         bottom: 0;
         left: 0;
         display: flex;
         align-items: center;
         justify-content: space-between;
      }
      .video .actionbar p {
         color: #626A6C;
         font-size: 14px;
         margin-left: 8px;
      }
      .video .actionbar .right-actions {
         margin-right: 8px;
         display: flex;
         align-items: center;
         justify-content: space-between;
      }
      .video .actionbar .right-actions p {
         line-height: 20px;
         font-size: 20px;
         display: flex;
         align-items: center;
         justify-content: space-between;
      }
      .video .actionbar .right-actions p.count {
         font-size: 14px;
         line-height: 20px;
      }
      .video .actionbar .right-actions .stem, .video .actionbar .right-actions .verwijder {
         margin-left: 16px;
         display: flex;
         align-items: center;
         justify-content: space-between;
	  }
      .video .actionbar .right-actions a {
         font-size: 20px;
         text-decoration: none;
      }
      .video .actionbar .right-actions .verwijder img{
         height: 16px;
         width: 16px;
         margin-right: 16px;
      }
      .video .actionbar .right-actions img {
         height: 20px;
         width: 20px;
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
       #filter_dropdown{
           position: relative;
           background-color: white;
           width: 100px;
           height: 100px;
           left: -20px;
           top: 10px;
           display: none;
       }
       #filter_dropdown li{
           padding: 15px;
           list-style-type: none;
           position: relative;
           left: 25px;
           top: -5px;
       }
       #filter_dropdown a{
           text-decoration: none;
           background-color: #FFF;
           color: #626A6C;
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
   </style>
</head>
</head>
<body>
    <div class="container">
        <div class="fill">
        </div>
        <div class="scherm">
            <img class="sysbar" src="images/sysbar-top.png" alt="android systeem balk" />
            <?php include_once("includes/mainHeader.php"); ?>
            <div class="modal" id="report_modal">
               <h2> Rapporteer </h2>
               <select class="category">
                   <option value="None"> - - - </option>
                    <option value="Taalgebruik">Ongepast taalgebruik</option>
                    <option value="Provocatie">Provocatie</option>
                    <option value="Racisme">Racisme</option>
                    <option value="Naaktheid">Naaktheid</option>
                </select>
               <input type="textarea" placeholder="Uw bericht" class="bericht">
               <div class="buttons">
                  <button class="cancel_report">ANNULEER</button>
                  <button class="report">OK</button>
               </div>
            </div>

            <div class="modal" id="verwijder_modal">
               <h2>Verwijder je video</h2>
               <p>Ben je zeker dat je de video wil verwij-<br />deren? De video wordt definitief verwij-<br />derd en kan niet meer hersteld worden. </p>
               <div class="buttons">
                  <button class="cancel_verwijder">ANNULEER</button>
                  <button class="delete">OK</button>
              </div>
            </div>

            <main>
               <nav>
                  <a href="index.php">Recent</a>
                  <a href="overview2.php">Favorieten</a>
                  <a href="overview3.php">Featured</a>
                  <a id="last-child" href="overview4.php">Eigen</a>
                  <div>
                     <img id="filter" src="images/ic_filter.svg" alt="filter icoon" />
                     <div id="filter_dropdown">
                     <ul>
                         <li><a href="#" id="filter1">Nieuwste</a></li>
                         <li><a href="#" id="filter2">Oudste</a></li>
                         <li><a href="#" id="filter3">Stemmen</a></li>
                     </ul>
                     </div>
                  </div>
               </nav>

               <div id="videocontainer">

                <?php foreach ( $res as $key => $video): ?>

                  <div class="video">
                     <div class="imgcontainer">
                        <a href='pages/videoPlayer.php?id=<?php echo $video["id"];?>'>
                         <video src="<?php echo "uploads/videos/" . $video["data"]?>" alt="video thumbnail">
                             <source src="uploads/videos/<?php echo $video["data"] ?>" type="video/webm">
                         </video>
                         </a>
                     </div>
                     <div class="actionbar">
                        <p class="naam"><?php echo $video["uploader"]?></p>
                        <p class="video_id"><?php echo $video["id"]?></p>
                        <div class="right-actions">
                          <?php if($video["uploader"] == $_SESSION["user"]) : ?>
                          <a href="#" class="verwijder">
                           <img src="images/ic_delete.svg" alt="verwijder je video" />
                            </a>
                           <?php else : ?>
                           <a href="#" class="rapporteer">
                               <p>!</p>
                           </a>
                           <?php endif ; ?>
                           <a href="#" class="stem">
                              <img src="images/ic_favorite.svg" alt="markeer als favoriet" />
                           </a>
                            <p class="count"><?php $videos->checkVote($video["id"], $_SESSION["userid"]);
        if($videos->Voted == true){
                                echo $videos->Votes;
    }
                                ?>
                            </p>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>

               </div>
               <button id="upload"><img src="images/ic_camera.svg" alt="opnemen camera icoon" /></button>
            </main>
            <img class="sysbar" src="images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="fill">
        </div>
    </div>
</body>
</html>
