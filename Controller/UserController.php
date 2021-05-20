<?php

require_once("model/UserDB.php");
require_once("ViewHelper.php");

class UserController {

    public static function showLoginForm() {
       ViewHelper::render("view/user-login.php");
    }

    public static function login() {
       if (UserDB::validLoginAttempt($_POST["username"], $_POST["password"])) {
            $vars = [
                "username" => $_POST["username"],
                "password" => $_POST["password"]
            ];

            ViewHelper::render("view/test.php", $vars);
       } else {
            ViewHelper::render("view/user-login.php", [
                "errorMessage" => "Invalid username or password."
            ]);
       }
    }

    public static function register(){
        if (UserDB::validRegisterAttempt($_POST["username"],$_POST["email"], $_POST["birthday"], $_POST["password"])){
            UserDB::register($_POST["username"],$_POST["email"], $_POST["birthday"], $_POST["password"]);
        }
        else{
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Email or username allready taken."
            ]);
        }
    }
}