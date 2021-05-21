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
        $db = DBInit::getInstance();

        $query = $db->prepare("SELECT COUNT(id) FROM user WHERE username = :username OR email = :email");
        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email );
        $query->execute();

        return $query->fetchColumn(0) == 0;
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

