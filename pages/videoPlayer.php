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
    /*360 op 640*/
    #videoscreen{
        width: 640px;
        height: 360px;
        background-color: red;
        overflow: hidden;
    }
    #video {
        position: relative;
        left: -50px;
        width: 640px;
    }
    #record {
        z-index: 100;
        position: absolute;
        top: 300px;
        left: 300px;
    }
    #upload-modal{
        display: none;
    }
</style>
<body>
   <a href="../overview.php"> terug </a>
   <a id="downloadLink" download="mediarecorder.webm" name="mediarecorder.webm" href></a>
    <div id="videoscreen">
       <video id="video" width="320" height="480" autoplay></video>
   </div>
   <input type="file" accept="image/*;capture=camera">
   <button id="pause"> || </button>
    <p id="data"></p>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</body>
</html>