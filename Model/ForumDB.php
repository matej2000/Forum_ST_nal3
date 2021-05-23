<?php

require_once "DBInit.php";

class ForumDB{
    
    public static function search($query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT IdPost, Pos_IdPost, Title, Content, Date, Likes FROM post
            WHERE Title LIKE :query OR Content LIKE :query ORDER BY Likes");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post WHERE IdPost = :IdPost");
        $statement->bindValue(":IdPost", $id);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getComments($id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post WHERE Pos_IdPost = :Pos_IdPost ORDER BY Likes");
        $statement->bindValue(":Pos_IdPost", $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function getCategory($idc){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM category WHERE IdC = :IdC");
        $statement->bindValue(":IdC", $idc);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getCategories($query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM category
            WHERE TitleC LIKE :query OR DescriptionC LIKE :query");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function insertPost($id, $title, $description, $idc){
        //TODO: VPIS V BAZO
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO post (IdC, Id, Title, Content, Date, Likes) VALUES (:IdC, :Id, :Title, :Content, :Date, :Likes);");

        $query->bindParam(":IdC", $idc);
        $query->bindParam(":Id", $id );
        $query->bindParam(":Title", $title);
        $query->bindParam(":Content", $description);
        $d = date('Y-m-d H:i:s');
        $query->bindParam(":Date", $d);
        $v = 0;
        $query->bindParam(":Likes", $v);
        $query->execute();

    }

    public static function categoryPosts($idc, $query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post
            WHERE IdC = :IdC AND (Title LIKE :query OR Content LIKE :query) ORDER BY Likes");
        $statement->bindParam(":IdC", $idc);
        $queryt = '%' . $query . '%';
        $statement->bindParam(":query", $queryt);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getMyPosts($id, $query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post
            WHERE Id = :Id AND (Title LIKE :query OR Content LIKE :query) ORDER BY Likes");
        $statement->bindParam(":Id", $id);
        $queryt = '%' . $query . '%';
        $statement->bindParam(":query", $queryt);
        $statement->execute();

        return $statement->fetchAll();
    }
}