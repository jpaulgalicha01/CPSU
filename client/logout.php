<?php
include 'includes/autoload.inc.php';

session_unset();
session_destroy();

setcookie("UserID",NULL, time()-3600, '/cpsu');
setcookie("TypeUser",NULL, time()-3600, '/cpsu');
ob_end_flush(header("Location: ../login.php"));
