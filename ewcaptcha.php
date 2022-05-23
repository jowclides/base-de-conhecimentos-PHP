<?php
namespace PHPMaker2020\PHPMAKER_Contatos;

// Session
session_start();

// Autoload
include_once "autoload.php";

// Captcha
$_SESSION[SESSION_CAPTCHA_CODE] = Captcha()->show();
?>