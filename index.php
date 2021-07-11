<?php

include 'ViewHelper.php';
require_once('Controller/UserController.php');
require_once('Controller/ForumController.php');
session_start();

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "Style/");
define("JS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "Script/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "forum" => function(){
        if (isset($_GET["query"])) {
            ForumController::search();
        } 
        else {
            if(isset($_POST["idpost"])){
                if(isset($_SESSION["username"])){
                    
                    if(isset($_POST["private"])){
                        // TODO: ČE JE PRIVATE = 1 NAREDI PRIVAT (POPRAVI BAZO) ČE JE 0 NAREDI JAVNO, VRNI STRAN PO VPISU V BAZO.
                        ForumController::private();
                    }
                    else if(isset($_POST["edit"])){
                        if(isset($_POST["title"]) && isset($_POST["content"])){
                            echo "tukaj";
                            ForumController::updatePost();
                        }
                        else{
                            echo "tukaj2";
                            ForumController::editPost();
                        }
                    }
                    else{
                        ForumController::like();
                    }
                }
                else{
                    echo BASE_URL;
                    ViewHelper::redirect(BASE_URL . "user/login");
                }
                
            }
            else{
                ForumController::content();
            }
        }
        
    },
    "forum/search" => function(){
        //if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST["idpost"])){
            if(isset($_SESSION["username"])){
                ForumController::like();
            }
            else{
                ViewHelper::redirect(BASE_URL . "user/login");
            }
        }
        else{
            ForumController::search();
        }
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
            if(isset($_POST["idpost"])){
                if(isset($_SESSION["username"])){
                    ForumController::like();
                }
                else{
                    echo BASE_URL;
                    ViewHelper::redirect(BASE_URL . "user/login");
                }
            }
            else{
                ForumController::categoryPosts();
            }
        }
        else{
            ForumController::searchCategory();
        }
    },
    "forum/addcategory" => function(){
        if(isset($_POST["title"])){
            ForumController::categoryAdd();
        }
        else{
            ViewHelper::render("View/forum-add-categories.php");
        }
    },
    "forum/myposts" => function(){
        if(isset($_SESSION["username"])){
            if(isset($_POST["idpost"])){
                ForumController::like();
            }
            else{
                ForumController::myPosts();
            }
        }
        else{
            ViewHelper::redirect(BASE_URL . "user/login");
        }
    },
    "forum/comment" => function(){
        if(isset($_SESSION["username"])){
            ForumController::comment();
        }
        else{
            ViewHelper::redirect(BASE_URL . "user/login");
        }
    },
    "forum/edit" => function() {
        if(isset($_SESSION["username"])){
            ForumController::updatePost();
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