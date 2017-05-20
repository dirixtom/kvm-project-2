<?php
    session_start();
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }

    spl_autoload_register(function ($class) {
        include_once("../classes/" . $class . ".php");
    });

    define("SCHERM", "Upload");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SCHERM; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:200,400,500" rel="stylesheet">
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
   .container {
      width: 100%;
      height: 100%;
      display: flex;
      overflow-y: visible;
      margin: auto;
   }
   #videoscreen{
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
   .modal {
      position: absolute;
      width: 280px;
      height: 234px;
      background-color: #FFF;
      border-radius: 4px;
      -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
      -moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
      box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.20);
   }
   #upload-modal{
      display: none;
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
      height: 30px;
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
      bottom: 8px;
      right: 0px;
   }
   .modal button {
      font-weight: 200;
      font-size: 14px;
      color: #OOO;
      background-color: #FFF;
      width: 80px;
      height: 30px;
      border: none;
      outline: none;
   }
   .modal button:first-child {
      color: #E22E2F;
   }
</style>
<body>
   <a id="downloadLink" download="mediarecorder.webm" name="mediarecorder.webm" href></a>
   <div id="videoscreen">
      <img id="left" src="../images/sysbar-left.png" />
      <video id="video"></video>
      <a href="../overview.php"><img id="terug" src="../images/ic_terugpijl.svg" /></a>
      <button id="record"><p></p><div id="inner"></div></button>
      <img id="right" src="../images/navbar-right.png" />
   </div>
   <div class="modal" id="upload-modal">
      <form action="" method="post">
         <h2>Voeg tags toe</h2>
         <p>Vul de tags in die u wilt toevoegen.
            Gescheiden door ; en een spatie. Klik op
            ok om uw upload te voltooien.
         </p>
         <input type="text" name="tags" id="tags" placeholder="Voeg tags toe">
         <input type="hidden" name="cancel" id="cancel" value="true">
         <div class="buttons">
            <button type="button" id="cancel">ANNULEER</button>
            <button type="submit" id="upload">OK</button>
         </div>
      </form>
   </div>
   <p id="data"></p>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/record.js"></script>
    <script src="../js/upload.js"></script>
</body>
</html>
