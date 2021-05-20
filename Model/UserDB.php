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
}

