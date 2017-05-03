<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="js/jquery.min.js"></script>
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
            overflow-y: scroll;
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
        }
        .scherm .sysbar:not(:first-child) {
            position: absolute;
            left: 0;
            bottom: 0;
        }
        .menu {
            position: absolute;
            display: block;
            background-color: #888;
            width: 280px;
            height: 600px;
            left: -280px;
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
        }
        .menuicon {
            position: absolute;
            top: 23px;
            left: 20px;
            display: block;
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
        .menuicon:hover + .menu, .menu:hover, .menuicon:active + .menu{
            left: 0px;
        }
        .hidden {
            visibility: hidden;
        }
        h1 {
            position: absolute;
            color: #FED600;
            top: 19px;
            left: 80px;
            font-family: 'Roboto', sans-serif;
            font-weight: normal;
            font-size: 23px;
        }
        header img {
            position: absolute;
            top: 20px;
            display: block;
            cursor: pointer;
            height: 24px;
            width: 24px;
        }
        header img#een {
            right: 120px;
        }
        header img#twee {
            right: 70px;
        }
        header img#drie {
            right: 20px;
        }
  </style>
</head>
<body>
    <div class="container">
        <div class="fill">
        </div>
        <div class="scherm">
            <img class="sysbar" src="images/sysbar-top.png" alt="android systeem balk" />
            <header>
                <img id="een" src="images/ic_search.svg" alt="vergrootglas_icon">
                <img id="twee" src="images/ic_live.svg" alt="livefeed_icon">
                <img id="drie" src="images/ic_notifications.svg" alt="notification_icon">
                <h1>Overzicht</h1>
                <div class="menuicon"><span></span></div>
                <div class="menu"></div>
            </header>
            <main>

            </main>
            <img class="sysbar" src="images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="fill">
        </div>
    </div>
</body>
</html>
