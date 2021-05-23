<?php

require_once("model/UserDB.php");
require_once("ViewHelper.php");
require_once("Model/ForumDB.php");

class ForumController {

    public static function search(){
        if (isset($_GET["query"])) {
            $query = $_GET["query"];
            $hits = ForumDB::search($query);
            foreach($hits as $key => $hit){
                if($hit["Pos_IdPost"] != null){
                    unset($hits[$key]);
                }
            }
        } else {
            $query = "";
            $hits = [];
        }
        ViewHelper::render("View/forum-search.php", ["hits" => $hits, "query" => $query]);
    }

    public static function content(){
        if(isset($_GET["id"])){
            $forum = ForumDB::get($_GET["id"]);
            // TODO: PREVERI ČE OBSTAJA
            ViewHelper::render("View/forum-content.php", ["forum" =>  $forum, "comments" => ForumDB::getComments($_GET["id"])]);
        }
        else{
            $query = "";
            ViewHelper::render("View/forum.php", ["query" => $query]);
        }
    }


    public static function add(){
        if(isset($_GET["idc"])){
            $category = ForumDB::getCategory($_GET["idc"]);
            ViewHelper::render("View/forum-add.php", ["category" => $category]);
        }
        else{
            if(isset($_GET["query"])){
                $query = $_GET["query"];
               
            }
            else{
                $query = "";
            }
            $hits = ForumDB::getCategories($query);
            ViewHelper::render("View/forum-select-category.php", ["hits" => $hits, "query" => $query]);
        }
    }

    public static function post(){
        //TODO: doadaj post v podatkovno bazo, dodaj sesion, preverjanje uporabnika
        ForumDB::insertPost(end($_SESSION["id"]), $_POST["title"], $_POST["content"], $_POST["idc"]);

    }

    public static function categoryPosts(){
        // Vrni poste za podano kategorijo
        if(isset($_GET["query"])){
            $query = $_GET["query"];
            
        }
        else{
            $query = "";
        }
        $category = ForumDB::getCategory($_GET["idc"]);
        $hits = ForumDB::categoryPosts($_GET["idc"], $query);
        foreach($hits as $key => $hit){
            if($hit["Pos_IdPost"] != null){
                unset($hits[$key]);
            }
        }
        ViewHelper::render("View/forum-category-posts.php", ["hits" => $hits, "query" => $query, "category" => $category]);
    }

    public static function searchCategory(){
        //Vrni categorije na podlagi iskanih podatkov.
        if(isset($_GET["query"])){
            $query = $_GET["query"];
        }
        else{
            $query = "";
        }
        $hits = ForumDB::getCategories($query);
        ViewHelper::render("View/forum-categories.php", ["hits" => $hits, "query" => $query]);
    }

    public static function myPosts(){
        if(isset($_GET["query"])){
            $query = $_GET["query"];
        }
        else{
            $query = "";
        }
        $hits = ForumDB::getMyPosts(end($_SESSION["id"]), $query);
        /*foreach($hits as $key => $hit){
            if($hit["Pos_IdPost"] != null){
              unset($hits[$key]);
            }
        }*/
        ViewHelper::render("View/forum-myposts.php", ["hits" => $hits, "query" => $query]);
    }
}