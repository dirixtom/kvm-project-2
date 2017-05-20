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
    <title>Upload</title>
</head>
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
   #videoscreen{
      position: relative;
      width: 640px;
      height: 360px;
      background-color: red;
      overflow: hidden;
   }
   #video {
      position: relative;
      margin-left: 24px;
      margin-right: 48px;
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
   button#record p {
      color: #FED600;
   }
   #inner {
      display: absolute;
      height: 32px;
      width: 32px;
      background-color: #FED600;
      border-radius: 50%;
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
   div.modal {
      
   }
   #upload-modal{
      display: none;
   }
</style>
<body>
   <a id="downloadLink" download="mediarecorder.webm" name="mediarecorder.webm" href></a>
   <div id="videoscreen">
      <img id="left" src="../images/sysbar-left.png" />
      <video id="video" loop>
      </video>
      <img id="terug" src="../images/ic_terugpijl.svg" />
      <button id="record"><p></p><div id="inner"></div></button>
      <img id="right" src="../images/navbar-right.png" />
   </div>
   <p id="data"></p>
   <br>
   <div class="modal" id="upload-modal">
      <form action="" method="post">
         <p>scheid de tags met een ; en een spatie</p>
         <input type="text" name="tags" id="tags" placeholder="voeg tags toe">
         <input type="hidden" name="cancel" id="cancel" value="true">
         <button type="button" id="cancel">video annuleren</button>
         <button type="submit" id="upload">Ok</button>
      </form>
    </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/record.js"></script>
    <script src="../js/upload.js"></script>
</body>
</html>
