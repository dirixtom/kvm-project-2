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
       <video id="video" width="320" height="480" controls></video>
   </div>
   <button id="record"> neem op </button>
    <p id="data"></p>
   <br>
   <div class="modal" id="upload-modal">
        <form action="" method="post">
                   <p>scheid de tags met een ; en een spatie</p>
                    <input type="text" name="tags" id="tags" placeholder="voeg tags toe">
                    <input type="hidden" name="cancel" id="cancel" value="true">
                    <br>
                    <button type="submit" id="cancel">video annuleren</button>
                    <br>
                    <button type="submit" id="upload">Ok</button>
                </form>
    </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/record.js"></script>
    <script src="../js/upload.js"></script>
</body>
</html>