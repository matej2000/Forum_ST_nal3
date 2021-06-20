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
        /*foreach($hits as $key => $hit){
            if($hit["post_idpost"] != null){
                unset($hits[$key]);
            }
        }*/
        $likesC = [];
        if(isset($_SESSION["username"])){
            foreach($hits as $hit){
                if(ForumDB::isLIked(end($_SESSION["id"]), $hit["idpost"])){
                    array_push($likesC, 1);
                }
                else{
                    //echo "ni lajkav" . end($_SESSION["id"]) . $hit["idpost"];
                    array_push($likesC, 0);
                }
                
            }
        }
        else{
            foreach($hits as $hit){
                array_push($likesC, 0);
            }
        }
        $allLikes = [];
        foreach($hits as $hit){
            array_push($allLikes, ForumDB::countLikes($hit["idpost"]));
        }

        ViewHelper::render("View/forum-search.php", ["hits" => $hits, "query" => $query, "likes" => $likesC, "alllikes" => $allLikes]);
    }

    public static function content(){
        if(isset($_GET["id"])){
            // podatki o avtorju
            $forum = ForumDB::get($_GET["id"]);
            $forumL = ForumDB::isLIked(end($_SESSION["id"]), $forum["idpost"]);
            if($forumL){
                $forumL = 1;
            }
            else{
                $forumL = 0;
            }
            $forumLC = ForumDB::countLikes($forum["idpost"]);
            $authorF = UserDB::getUser($forum["user_iduser"]);
            // podatki o komentarjih
            $comments = ForumDB::getComments($_GET["id"]);
            $usersC = [];
            $commentsL = [];
            $commentsLC = [];
            foreach($comments as $comment){
                array_push($usersC, UserDB::getUser($comment["user_iduser"]));
                if(ForumDB::isLIked(end($_SESSION["id"]), $comment["idpost"])){
                    array_push($commentsL, 1);
                }
                else{
                    //echo "ni lajkav" . end($_SESSION["id"]) . $hit["idpost"];
                    array_push($commentsL, 0);
                }
                array_push($commentsLC, ForumDB::countLikes($comment["idpost"]));
            }
            
            
            // TODO: PREVERI ČE OBSTAJA
            ViewHelper::render("View/forum-content.php", ["forum" =>  $forum, "foruml" => $forumL, "forumlc" => $forumLC, 
            "comments" => $comments, "author" => $authorF, "usersc" => $usersC, "commentsl" => $commentsL, 
            "commentslc" => $commentsLC]);
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
        /*foreach($hits as $key => $hit){
            if($hit["post_idpost"] != null){
                unset($hits[$key]);
            }
        }*/
        $likesC = [];
        if(isset($_SESSION["username"])){
            foreach($hits as $hit){
                if(ForumDB::isLIked(end($_SESSION["id"]), $hit["idpost"])){
                    array_push($likesC, 1);
                }
                else{
                    //echo "ni lajkav" . end($_SESSION["id"]) . $hit["idpost"];
                    array_push($likesC, 0);
                }
                
            }
        }
        else{
            foreach($hits as $hit){
                array_push($likesC, 0);
            }
        }
        $allLikes = [];
        foreach($hits as $hit){
            array_push($allLikes, ForumDB::countLikes($hit["idpost"]));
        }

        ViewHelper::render("View/forum-category-posts.php", ["hits" => $hits, "query" => $query, "category" => $category, "likes" => $likesC, "alllikes" => $allLikes]);
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

        $likesC = [];
        if(isset($_SESSION["username"])){
            foreach($hits as $hit){
                if(ForumDB::isLIked(end($_SESSION["id"]), $hit["idpost"])){
                    array_push($likesC, 1);
                }
                else{
                    array_push($likesC, 0);
                }
                
            }
        }
        else{
            foreach($hits as $hit){
                array_push($likesC, 0);
            }
        }
        $allLikes = [];
        foreach($hits as $hit){
            array_push($allLikes, ForumDB::countLikes($hit["idpost"]));
        }

        ViewHelper::render("View/forum-myposts.php", ["hits" => $hits, "query" => $query, "likes" => $likesC, "alllikes" => $allLikes]);
    }

    public static function comment(){
        ForumDB::comment($_POST["IdC"], $_POST["Pos_IdPost"], $_POST["Id"], "", $_POST["content"]);
        ViewHelper::redirect(BASE_URL . "forum?id=" . $_POST["Pos_IdPost"]);
    }

    public static function like(){

        if(ForumDB::isLiked(end($_SESSION["id"]), $_POST["idpost"])){
            ForumDB::unlike(end($_SESSION["id"]), $_POST["idpost"]);
            $likes = ForumDB::countLikes($_POST["idpost"]);
            echo "" . $_POST["idpost"] . "/" . $likes . "/unlike";
        }
        else{
            ForumDB::like(end($_SESSION["id"]), $_POST["idpost"]);
            $likes = ForumDB::countLikes($_POST["idpost"]);
            echo "" . $_POST["idpost"] . "/" . $likes . "/like";
        }

    }

    public static function private(){
        $post = ForumDB::get($_POST["idpost"]);
        if(end($_SESSION["id"]) == $post["user_iduser"]){
            if($_POST["private"] == 0){
                if($post["removed"] != 0){
                    ForumDB::private($_POST["idpost"], 0);
                }
            }
            else if ( $_POST["private"] == 1){
                if($post["removed"] != 1){
                    ForumDB::private($_POST["idpost"], 1);
                }
            }
        }
        ViewHelper::redirect(BASE_URL . "forum?id=" . $_POST["idpost"]);
    }
}