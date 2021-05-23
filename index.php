<?php

include 'ViewHelper.php';
require_once('Controller/UserController.php');
require_once('Controller/ForumController.php');
session_start();

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "forum" => function(){
        if (isset($_GET["query"])) {
            ForumController::search();
        } 
        else {
            ForumController::content();
        }
        
    },
    "forum/search" => function(){
        ForumController::search();
    },
    "forum/add" => function(){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_SESSION["username"])){
                ForumController::post();
                ViewHelper::render("View/forum-added.php");
            }
        }
        else{
            ForumController::add();
        }
    },
    "forum/category" => function(){
        if (isset($_GET["idc"])){
            ForumController::categoryPosts();
        }
        else{
            ForumController::searchCategory();
            //TODO: kaj se zgodi ko idc ni nastavljen
        }
    },
    "user/login" => function() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::login();
        } else {
            ViewHelper::render("View/user-login.php");
        }
    },
    "user/register" => function(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::register();
        } else {
            $errors["username"] = "";
            $errors["email"] = "";
            $errors["birthday"] =  "";
            $errors["password"] = "";
            $errors["exist"] = "";
            ViewHelper::render("View/user-register.php", ["errors" => $errors]);
        }
    },
    "user/logout" => function(){
        if(isset($_SESSION["username"])){
            session_start();
            $_SESSION = array();
            session_destroy();
        }
        ViewHelper::redirect(BASE_URL . "forum");
    },
    "test" => function(){
        ViewHelper::render("View/test.php");
    },

    "" => function(){
        ViewHelper::redirect(BASE_URL . "forum");
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