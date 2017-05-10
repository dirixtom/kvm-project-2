<?php
    session_start();
    if (isset($_SESSION['recorded']) && isset($_SESSION['user'])) {
    } else {
        header('Location: record.php');
    }

    spl_autoload_register(function ($class) {
        include_once("../classes/" . $class . ".php");
    });

    if(!empty($_POST)){
        unlink("../uploads/videos/" . $_SESSION["recorded"]);
        unset($_SESSION['recorded']);
        header ("Location: record.php");
    }
define("SCHERM", "video uploaden");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo SCHERM; ?></title>
    
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
        h1 {
            position: absolute;
            color: #FED600;
            top: 20px;
            left: 65px;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 23px;
        }
        h2 {
            position: relative;
            color: #626A6C;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            font-size: 23px;
            margin-left: 20px;
            padding-top: 28px;
        }
        header img {
            position: absolute;
            top: 24px;
            display: block;
            cursor: pointer;
            height: 18px;
            left: 20px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="fill">
        </div>
        <div class="scherm">
            <img class="sysbar" src="../images/sysbar-top.png" alt="android systeem balk" />
            <?php include_once("../includes/simpleHeader.php") ?>
            <main>
                <form action="" method="post">
                   <p>scheid de tags met een ; en een spatie</p>
                    <input type="text" name="tags" id="tags" placeholder="voeg tags toe">
                    <input type="hidden" name="cancel" id="cancel" value="true">
                    <br>
                    <button type="submit" id="cancel">video annuleren</button>
                    <br>
                    <button type="submit" id="upload">Ok</button>
                </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/upload.js"></script>
    </main>
            <img class="sysbar" src="../images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="fill">
        </div>
    </div>
</body>
</html>
