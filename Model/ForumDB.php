<?php

require_once "DBInit.php";

class ForumDB{
    
    public static function search($query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT IdPost, Title, Content, Date, Likes FROM post
            WHERE Title LIKE :query OR Content LIKE :query ORDER BY Likes");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }
}