<?php
include 'includes/autoload.inc.php';

session_unset();
session_destroy();

setcookie("UserID", NULL, time() - 3600, '/CPSU-Main/CPSU');
setcookie("TypeUser", NULL, time() - 3600, '/CPSU-Main/CPSU');
ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
