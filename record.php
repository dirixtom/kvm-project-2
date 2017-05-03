<!DOCTYPE html>
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
</style>
<body>
   <a href="overview.php"> terug </a>
    <div id="videoscreen">
       <video id="video" width="320" height="480" autoplay></video>
   </div>
   <button id="record"> neem op </button>
   <br>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/record.js"></script>
</body>
</html>