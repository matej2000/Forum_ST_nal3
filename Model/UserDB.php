<?php

require_once "DBInit.php";

class UserDB {

    // Returns true if a valid combination of a username and a password are provided.
    public static function validLoginAttempt($username, $password) {
        $db = DBInit::getInstance();

        $query = $db->prepare("SELECT password FROM user WHERE username = :username");
        $query->bindParam(":username", $username);
        $query->execute();

        $user = $query->fetch();

        if(password_verify($password, $user["password"])){
            unset($user["password"]);
            return true;
        }
        else{
            return false;
        }
    }

    public static function validRegisterAttempt($username, $email, $birthday, $password){
        $rules = [
            "username" => FILTER_SANITIZE_SPECIAL_CHARS,
            "email" => FILTER_VALIDATE_EMAIL,
            "birthday" => [
                "filter" => FILTER_CALLBACK,
                "options" => function ($value) {return (strtotime($value) <= strtotime('-18 year')) && (strtotime($value) > strtotime('-150 year'));}
            ],
            "password" =>[
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^.{8,}$/"]
            ]
        ];
        //.*[0-9]+.*
        $data = filter_input_array(INPUT_POST, $rules);
        $passTest1 = filter_var($password, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[0-9]*$/"]]);
    
        $errors["username"] = $data["username"] === false ? "Provide the username: only letters, dots, dashes and spaces are allowed." : "";
        $errors["email"] = $data["email"] === false ? "Wrong email format." : "";
        $errors["birthday"] = $data["birthday"] === false ? "You should be odler than 17 and yunger than 150 years." : "";
        $errors["password"] = $data["password"] === false || $passTest1 == "" ? "Password sholud be at least 8 characters long and contain a number." : "";

        $db = DBInit::getInstance();

        $query = $db->prepare("SELECT COUNT(id) FROM user WHERE username = :username OR email = :email");
        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email );
        $query->execute();
        $errors["exist"] = ($query->fetchColumn(0) == 0) === false ? "Email or username allready exists." : "";

        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($errors);
        }
        
        if($isDataValid){
            return false;
        }
        return $errors;
    }

    public static function register($username, $email, $birthday, $password){
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO user (UserName, Email, Birthday, Password) VALUES (:username, :email, :birthday, :password);");

        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email );
        $query->bindParam(":birthday", $birthday);
        $hash= password_hash($password, PASSWORD_DEFAULT);
        $query->bindParam(":password", $hash);
        $query->execute();
    }
}

