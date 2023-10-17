<?php
session_start();
$menu=$_GET[menu];
$_SESSION[menu]=$menu;
header('location:index.php');

?>