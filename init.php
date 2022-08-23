<?php
    require_once('connect.php');
    if(session_id() == '')session_start();
    require_once("functions.php");
    $title = isset($title) ? $title : "Default";
    require_once("header.php");
?>