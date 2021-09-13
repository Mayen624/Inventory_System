<?php
    $lang = $_GET["language"];
    session_start();
    $_SESSION["lang"] = $lang;
    header("location: descarga.php");
?>