<?php
    session_start();
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: login.php');
    }
    
    define("SCHERM", "Overzicht");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SCHERM; ?></title>
</head>
<body>
    <?php include_once("appNav.inc.php"); ?>
    
    <button id="upload"> + </button>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/overview.js"></script>
</body>
</html>