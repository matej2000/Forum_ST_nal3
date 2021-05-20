<?php

require_once "DBInit.php";

class UserDB {

    // Returns true if a valid combination of a username and a password are provided.
    public static function validLoginAttempt($username, $password) {
        $db = DBInit::getInstance();

        $query = $db->prepare("SELECT COUNT(id) FROM user WHERE username = :username AND password = :password");
        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password );
        $query->execute();

        return $query->fetchColumn(0) == 1;
    }

    public static function validRegisterAttempt($username, $email, $password){
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
        $query->bindParam(":birhday", $birthday);
        $query->bindParam(":password", $password);
        $query->execute();
        $query->execute();
    }
}

