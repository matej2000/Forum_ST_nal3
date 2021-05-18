<?php

session_start();

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("ASSETS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "assets/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "main" => function(){
        ViewHelper::render("View/test.php");
    },
    "user/login" => function() {
        echo "Nedela se";
    },
    "user/register" => function(){
        echo "Nedela se";
    },

    "" => function(){
        ViewHelper::redirect(BASE_URL . "main");
    },
];

try{
    if(isset($urls[$path])){
        $urls[$path];
    }
    else{
        echo "No cotroller for '$path'";
    }
} catch(Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
}