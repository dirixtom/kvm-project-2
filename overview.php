<?php
    /*session_start();
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }*/

    define("SCHERM", "Overzicht");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo SCHERM; ?></title>

	<script src="js/jquery.min.js"></script>
   <script src="js/overview.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
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
            overflow-y: visible;
            margin: auto;
        }
        main {
            width: 360px;
            height: 495px;
            background: #FFF;
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
            z-index: 1;
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
            z-index: 0;
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
        
        button#upload img {
           width: 20px;
        }
  </style>
</head>
<body>
    <div class="container">
        <div class="fill">
        </div>
        <div class="scherm">
            <img class="sysbar" src="images/sysbar-top.png" alt="android systeem balk" />
            <?php include_once("includes/mainHeader.php") ?>
            <main>
                <button id="upload"><img src="images/ic_camera.svg" alt="opnemen camera icoon" /></button>
            </main>
            <img class="sysbar" src="images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="fill">
        </div>
    </div>
</body>
</html>
