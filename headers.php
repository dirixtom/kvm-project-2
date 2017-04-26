<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="js/jquery.min.js"></script>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        html {
            background: #FFF;
        }
        html, body {
            width: 100vw;
            height: 100vh;
        }
        .container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: Gainsboro;
        }
        main {
            width: 360px;
            height: 495px;
            background: #FFF;
        }
        .scherm {
            position: relative;
            float: left;
            background: Gainsboro;
            height: 640px;
            width: 360px;
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
        .scherm img:first-child {
            width: 100%;
            margin-bottom: -4px;
        }
        .scherm img:not(:first-child) {
            position: absolute;
            left: 0;
            bottom: 0;
        }
        .menu {
            display: block;
            background-color: #888;
            width: 280px;
            height: 600px;
            z-index: -6000000000;
            margin-left: -280px;
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
            top: 10px;
            left: 10px;
            display: block;
            cursor: pointer;
            height: 8px*2 + 5px; /* margin*2 + hoogte van span */
            width: 25px;
        }
        span {
            display: block;
            top: 8px;
            width: 25px;
            height: 5px;
            background-color: #000;
            position: relative;
        }
        span::after, span::before {
            display: block;
            content: '';
            position: absolute;
            width: 25px;
            height: 5px;
            background-color: #000;
            -webkit-transition-property: margin, -webkit-transform;
            -webkit-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -ms-transition-duration: .2s;
            -o-transition-duration: .2s;
            transition-duration: .2s;
            -webkit-transition-delay: .2s, 0;
            -moz-transition-delay: .2s, 0;
            -ms-transition-delay: .2s, 0;
            -o-transition-delay: .2s, 0;
            transition-delay: .2s, 0;
        }
        span::before {
            margin-top: -8px;
        }
        span::after {
            margin-top: 8px;
        }
        .menuicon:hover ~ .menu, .menu:hover {
            margin-left: 0px;
        }
  </style>
  <script>
  </script>
</head>
<body>
    <div class="container">
        <div class="scherm">
        </div>
        <div class="scherm">
            <img src="images/sysbar-top.png" alt="android systeem balk" />
            <header>
                <!--<input type="checkbox" id="hamburger" name="hamburger"/>-->
                <label class="menuicon" for="hamburger"><span></span></label>
                <div class="menu">
                    <h1>KIEKEBOE</h1>
                </div>
            </header>
            <main>

            </main>
            <img src="images/navbar-bot.png" alt="android navigatie balk" />
        </div>
        <div class="scherm">
        </div>
    </div>
</body>
</html>
