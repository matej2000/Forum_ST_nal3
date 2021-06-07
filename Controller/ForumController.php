<?php

require_once("Model/UserDB.php");
require_once("ViewHelper.php");
require_once("Model/ForumDB.php");

class ForumController {

    public static function search(){
        if (isset($_GET["query"])) {
            $query = $_GET["query"];
            
        } else {
            $query = "";
        }
        $hits = ForumDB::search($query);
        foreach($hits as $key => $hit){
            if($hit["Pos_IdPost"] != null){
                unset($hits[$key]);
            }
        }
        ViewHelper::render("View/forum-search.php", ["hits" => $hits, "query" => $query]);
    }

    public static function content(){
        if(isset($_GET["id"])){
            $forum = ForumDB::get($_GET["id"]);
            $comments = ForumDB::getComments($_GET["id"]);
            $authorF = UserDB::getUser($forum["Id"]);
            $usersC = [];
            foreach($comments as $comment){
                array_push($usersC, UserDB::getUser($comment["Id"]));
            }
            
            // TODO: PREVERI ČE OBSTAJA
            ViewHelper::render("View/forum-content.php", ["forum" =>  $forum, "comments" => $comments, "author" => $authorF, "usersc" => $usersC]);
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

    public static function categoryAdd(){
        // TODO: preveri če kategorija s tem naslovom že obstaja
        if(ForumDB::existCategory($_POST["title"])){
            ForumDB::addCategory($_POST["title"], $_POST["content"]);
            ViewHelper::redirect(BASE_URL . "forum/category");
        }
        else{
            ViewHelper::render("View/forum-add-categories.php", ["errorMessage" => "Category allready exists."]);
        }
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

    public static function comment(){
        ForumDB::comment($_POST["IdC"], $_POST["Pos_IdPost"], $_POST["Id"], "", $_POST["content"]);
        ViewHelper::redirect(BASE_URL . "forum?id=" . $_POST["Pos_IdPost"]);
    }
}