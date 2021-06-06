<?php

require_once "DBInit.php";

class ForumDB{
    
    public static function search($query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT IdPost, Pos_IdPost, Title, Content, Date, Likes FROM Post
            WHERE Title LIKE :query OR Content LIKE :query ORDER BY Likes");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Post WHERE IdPost = :IdPost");
        $statement->bindValue(":IdPost", $id);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getComments($id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Post WHERE Pos_IdPost = :Pos_IdPost ORDER BY Likes");
        $statement->bindValue(":Pos_IdPost", $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function getCategory($idc){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Category WHERE IdC = :IdC");
        $statement->bindValue(":IdC", $idc);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getCategories($query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Category
            WHERE TitleC LIKE :query OR DescriptionC LIKE :query");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function insertPost($id, $title, $description, $idc){
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO Post (IdC, Id, Title, Content, Date, Likes) VALUES (:IdC, :Id, :Title, :Content, :Date, :Likes);");

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

        $statement = $db->prepare("SELECT * FROM Post
            WHERE IdC = :IdC AND (Title LIKE :query OR Content LIKE :query) ORDER BY Likes");
        $statement->bindParam(":IdC", $idc);
        $queryt = '%' . $query . '%';
        $statement->bindParam(":query", $queryt);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getMyPosts($id, $query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Post
            WHERE Id = :Id AND (Title LIKE :query OR Content LIKE :query) ORDER BY Likes");
        $statement->bindParam(":Id", $id);
        $queryt = '%' . $query . '%';
        $statement->bindParam(":query", $queryt);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function comment($Idc, $Pos_IdPost, $Id, $title, $Content){
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO Post (IdC, Pos_IdPost, Id, Title, Content, Date, Likes) VALUES (:IdC, :Pos_IdPost, :Id, :Title, :Content, :Date, :Likes);");

        $query->bindParam(":IdC", $Idc);
        $query->bindParam(":Pos_IdPost", $Pos_IdPost);
        $query->bindParam(":Id", $Id );
        $query->bindParam(":Title", $title);
        $query->bindParam(":Content", $Content);
        $d = date('Y-m-d H:i:s');
        $query->bindParam(":Date", $d);
        $v = 0;
        $query->bindParam(":Likes", $v);
        $query->execute();
    }
}