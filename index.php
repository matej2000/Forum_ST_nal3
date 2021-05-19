<?php

include 'ViewHelper.php';
session_start();

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "main" => function(){
        ViewHelper::render("View/test.php");
    },
    "user/login" => function() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Prijavljen";
        } else {
            ViewHelper::render("View/user-login.php");
        }
    },
    "user/register" => function(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Registriran";
        } else {
            ViewHelper::render("View/user-register.php");
        }
    },

    "" => function(){
        ViewHelper::redirect(BASE_URL . "main");
    },
];

try{
    if(isset($urls[$path])){
        $urls[$path]();
    }
    else{
        echo "No cotroller for '$path'";
    }
} catch(Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
}