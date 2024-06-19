<?php
date_default_timezone_set('Asia/Manila');

$date = date('Y-m-d');

include 'dbConnection/ClsConnection.php';
include "config/security.php";
spl_autoload_register("Autoload");

function Autoload($classname){
    $path = "config/";
    $extenstion = ".config.php";
    $full_path = $path . $classname . $extenstion;

    if(!file_exists($full_path)){
        return false;
    }
    include_once $full_path;
}

function secured($data){
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripcslashes($data);
    $data = str_replace("'","\'",$data);
    return $data;
}


?>