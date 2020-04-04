<?php

session_start();

$lang = isset($_GET["lang"]) ? $_GET["lang"] : "en";

$_SESSION["LANGUAGE"] = $lang;

header('Location: ' . $_SERVER['HTTP_REFERER']);
// header("location:javascript://history.go(-1)");






?>