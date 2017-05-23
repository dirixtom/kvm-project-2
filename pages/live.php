<?php
    session_start();
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }

    spl_autoload_register(function ($class) {
        include_once("../classes/" . $class . ".php");
    });

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Player</title>

<style>
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
    display: flex;
    align-items: center;
    justify-content: center;
   }
   .container {
    width: 100%;
    height: 100%;
    display: flex;
    overflow-y: visible;
    margin: auto;
   }
   #videoscreen {
    position: relative;
    width: 640px;
    height: 360px;
    background-color: red;
    overflow-y: hidden;
   }
   #video {
    position: absolute;
    top: 0px;
    left: 24px;
    width: 568px;
    z-index: 0;
   }
   button#record {
    width: 40px;
    height: 40px;
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
    top: 50%;
    transform: translateY(-50%);
    right: 64px;
   }
   #videoscreen {
      width: 640px;
      height: 360px;
      overflow: hidden;
   }
   #video {
      position: absolute;
      top: 0px;
      left: 24px;
      width: 568px;
      z-index: 0;
   }
   img#terug{
      position: absolute;
      border: none;
      outline: none;
      top: 12px;
      left: 36px;
      width: 16px;
   }
   img#left {
      position: absolute;
      top: 0px;
      left: 0px;
   }
   img#right {
      position: absolute;
      top: 0px;
      right: 0px;
   }
   #controlbar {
      position: absolute;
      width: 100%;
      height: 32px;
      background-color: #000;
      opacity: 0.30;
      bottom: 0px;
      left: 0px;
      z-index: 1;
   }
   #buttons {
      position: absolute;
      width: 100%;
      height: 32px;
      bottom: 0px;
      left: 0px;
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: space-between;
   }
   #buttons div {
      margin-left: 36px;
      display: flex;
      align-items: center;
   }
   #buttons button {
      position: relative;
      height: 16px;
      border: none;
      outline: none;
      background-color: rgba(0, 0, 0, 0);
      margin-right: 16px;
   }
   #buttons button:last-child {
      margin-right: 60px;
   }
   #buttons button img {
      height: 16px;
   }
    iframe{
        position: relative;
        left: 22px;
    }
</style>
</head>
<body>
   <a id="downloadLink" download="mediarecorder.webm" name="mediarecorder.webm" href></a>
    <div id="videoscreen">
      <img id="left" src="../images/sysbar-left.png" />
      <div id="twitch">
       <!--<iframe
    src="http://player.twitch.tv/?channel=bigbangs06&muted=true"
    height="360"
    width="570"
    frameborder="0"
    scrolling="no"
    allowfullscreen="false">
</iframe>-->
        </div>
       <div id="controlbar"></div>
       <a href="../index.php"><img id="terug" src="../images/ic_terugpijl.svg" /></a>
       <img id="right" src="../images/navbar-right.png" />
   </div>
   
    <p id="data"></p>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <script src= "http://player.twitch.tv/js/embed/v1.js"></script>
   <script src="../js/live.js"></script>
</body>
</html>
