<?php

require_once "DBInit.php";

class ForumDB{
    
    public static function search($query){
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT idpost, post_idpost, title, content, time, likes, removed, edited FROM post WHERE post_idpost IS NULL AND 
        (title LIKE :query OR content LIKE :query)  ORDER BY time");
        /*$statement = $db->prepare("SELECT idpost, post_idpost, title, content, time, likes FROM post
            WHERE title LIKE :query OR content LIKE :query ORDER BY likes");*/
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post WHERE idpost = :IdPost");
        $statement->bindValue(":IdPost", $id);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getComments($id){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post WHERE post_idpost = :Pos_IdPost ORDER BY Likes");
        $statement->bindValue(":Pos_IdPost", $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function getCategory($idc){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM category WHERE idcategory = :IdC");
        $statement->bindValue(":IdC", $idc);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getCategories($query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM category
            WHERE name LIKE :query OR description LIKE :query");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function insertPost($id, $title, $description, $idc){
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO post (category_idcategory, user_iduser, title, content, time, edited, likes) VALUES (:IdC, :Id, :Title, :Content, :Date, :edited, :Likes);");

        $query->bindParam(":IdC", $idc);
        $query->bindParam(":Id", $id );
        $query->bindParam(":Title", $title);
        $query->bindParam(":Content", $description);
        $d = date('Y-m-d H:i:s');
        $query->bindParam(":Date", $d);
        $v = 0;
        $query->bindParam(":edited", $v);
        $query->bindParam(":Likes", $v);
        $query->execute();

    }

    public static function categoryPosts($idc, $query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post
            WHERE category_idcategory = :IdC AND post_idpost IS NULL AND (title LIKE :query OR content LIKE :query) ORDER BY likes");
        $statement->bindParam(":IdC", $idc);
        $queryt = '%' . $query . '%';
        $statement->bindParam(":query", $queryt);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function addCategory($title, $description){
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO category (name, desription) VALUES (:Title, :DescriptionC);");

        $query->bindParam(":Title", $title);
        $query->bindParam(":DescriptionC", $description);
        $query->execute();
    }

    public static function existCategory($title){
        $db = DBInit::getInstance();

        $query = $db->prepare("SELECT COUNT(idcategory) FROM category WHERE name= :title");
        $query->bindParam(":title", $title);
        $query->execute();
        return $query->fetchColumn(0) == 0;
    }

    public static function getMyPosts($id, $query){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM post
            WHERE user_iduser = :Id AND (title LIKE :query OR content LIKE :query) ORDER BY likes");
        $statement->bindParam(":Id", $id);
        $queryt = '%' . $query . '%';
        $statement->bindParam(":query", $queryt);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function comment($Idc, $Pos_IdPost, $Id, $title, $Content){
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO post (category_idcategory, post_idpost, user_iduser, title, content, time, edited, likes) VALUES (:IdC, :Pos_IdPost, :Id, :Title, :Content, :Date, :edited, :Likes);");

        $query->bindParam(":IdC", $Idc);
        $query->bindParam(":Pos_IdPost", $Pos_IdPost);
        $query->bindParam(":Id", $Id );
        $query->bindParam(":Title", $title);
        $query->bindParam(":Content", $Content);
        $d = date('Y-m-d H:i:s');
        $query->bindParam(":Date", $d);
        $v = 0;
        $query->bindParam(":edited", $v);
        $query->bindParam(":Likes", $v);
        $query->execute();
    }

    public static function isLIked($iduser, $idpost){
        $db = DBInit::getInstance();

        $query = $db->prepare("SELECT COUNT(user_iduser) FROM likes WHERE user_iduser= :iduser AND post_idpost = :idpost");
        $query->bindParam(":iduser", $iduser);
        $query->bindParam(":idpost", $idpost);
        $query->execute();
        return $query->fetchColumn(0) > 0;
    }

    public static function unlike($iduser, $idpost){
        $db = DBInit::getInstance();

        $query = $db->prepare("DELETE FROM likes WHERE user_iduser=:iduser AND post_idpost=:idpost;");

        $query->bindParam(":iduser", $iduser);
        $query->bindParam(":idpost", $idpost);
        $query->execute();
    }

    public static function like($iduser, $idpost){
        $db = DBInit::getInstance();

        $query = $db->prepare("INSERT INTO likes (user_iduser, post_idpost) VALUES (:iduser, :idpost);");

        $query->bindParam(":iduser", $iduser);
        $query->bindParam(":idpost", $idpost);
        $query->execute();
    }

    public static function countLikes($idpost){
        $db = DBInit::getInstance();

        $query = $db->prepare("SELECT COUNT(user_iduser) FROM likes WHERE post_idpost = :idpost");
        $query->bindParam(":idpost", $idpost);
        $query->execute();
        return $query->fetchColumn(0);
    }

    public static function private($idpost, $value){
        $db = DBInit::getInstance();
        $query = $db->prepare("UPDATE post SET removed=:v WHERE idpost=:idpost");
        $query->bindParam(":v", $value);
        $query->bindParam(":idpost", $idpost);
        $query->execute();
    }

}