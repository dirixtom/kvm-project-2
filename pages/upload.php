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
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="tags" id="tags" placeholder="voeg tags toe">
        <input type="hidden" name="cancel" id="cancel" value="true">
        <br>
        <button type="submit" id="cancel">video annuleren</button>
        <br>
        <button type="submit" id="upload">Ok</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="../js/upload.js"></script>
</body>
</html>
