<?php
    session_start();
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }

    spl_autoload_register(function ($class) {
        include_once("../classes/" . $class . ".php");
    });
    
    $id = $_GET["id"];
    $video = new Video;
    $res = $video->show($id);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Player</title>
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
    #buttons {
        z-index: 100;
        position: absolute;
        top: 350px;
        left: 20px;
    }
    #upload-modal{
        display: none;
    }
</style>
<body>
   <a href="../overview.php"> terug </a>
   <a id="downloadLink" download="mediarecorder.webm" name="mediarecorder.webm" href></a>
    <div id="videoscreen">
       <video id="video" width="320" height="480" controls>
           <source src="../uploads/videos/<?php echo $res["data"] ?>" type="video/webm">
       </video>
   </div>
   <div id="buttons">
   <button id="pause"> pauzeer </button>
   <button id="replay"> replay </button>
   <button id="mute"> mute </button>
   </div>
    <p id="data"></p>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <script src="../js/videoPlayer.js"></script>
</body>
</html>