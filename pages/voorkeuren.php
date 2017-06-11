<?php
    session_start();
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }

    define("SCHERM", "Notificatie voorkeuren");

    spl_autoload_register(function ($class) {
        include_once("../classes/" . $class . ".php");
    });

    $melding = new Melding;
    $res = $melding->readSettings();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo SCHERM; ?></title>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/voorkeuren.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

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
            justify-content: center !important;
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
        .cat {
            position: relative;
            width: 100%;
            margin: 0 auto;
        }
        .cat:last-child {
            margin-top: 30px;
        }
        .selections {
            position: relative;
            width: calc(100% - 20px);
            margin-left: 20px;
            margin-top: 30px;
        }
        .selections p {
            position: relative;
            margin-top: 20px;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            color: #95989A;
            font-size: 16px;
        }
        .switch {
            top: 0;
            position: absolute;
            right: 20px;
            display: inline-block;
            width: 34px;
            height: 14px;
        }
        .switch input {
            display: none;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 3px;
            left: 0;
            right: 0;
            bottom: -3px;
            background-color: #FADFE0;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            top: -3px;
            background-color: #E22E2F;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #E2F1DA;
        }

        input:checked + .slider:before {
            background-color: #44A80F;
            -webkit-transform: translateX(18px);
            -ms-transform: translateX(18px);
            transform: translateX(18px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
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
                <div class="cat">
                    <h2>Pushberichten</h2>
                    <div class="selections">
                        <p>Verkozen video</p>
                        <label class="switch">
                            <input id="pushVerkozen" type="checkbox" <?php if($res["push_video"] == "true"){echo "checked='checked'";} ?> >
                            <div class="slider round"></div>
                        </label>
                    </div>
                    <div class="selections">
                        <p>Upload door vrienden</p>
                        <label class="switch">
                            <input id="pushVriendUpload" type="checkbox" <?php if($res["push_upload"] == "true"){echo "checked='checked'";} ?> >
                            <div class="slider round"></div>
                        </label>
                    </div>
                    <div class="selections">
                        <p>Profiel status updates</p>
                        <label class="switch">
                            <input id="pushProfielStatus" type="checkbox" <?php if($res["push_status"] == "true"){echo "checked='checked'";} ?> >
                            <div class="slider round"></div>
                        </label>
                    </div>
                </div>
                <div class="cat">
                    <h2>E-mail</h2>
                    <div class="selections">
                        <p>Verkozen video</p>
                        <label class="switch">
                            <input id="emailVerkozen" type="checkbox" <?php if($res["mail_video"] == "true"){echo "checked='checked'";} ?> >
                            <div class="slider round"></div>
                        </label>
                    </div>
                    <div class="selections">
                        <p>Upload door vrienden</p>
                        <label class="switch">
                            <input id="emailVriendUpload" type="checkbox" <?php if($res["mail_upload"] == "true"){echo "checked='checked'";} ?> >
                            <div class="slider round"></div>
                        </label>
                    </div>
                    <div class="selections">
                        <p>Profiel status updates</p>
                        <label class="switch">
                            <input id="emailProfielStatus" type="checkbox" <?php if($res["mail_status"] == "true"){echo "checked='checked'";} ?> >
                            <div class="slider round"></div>
                        </label>
                    </div>
                </div>
            </main>
            <img class="sysbar" src="../images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="fill">
        </div>
    </div>
</body>
</html>
