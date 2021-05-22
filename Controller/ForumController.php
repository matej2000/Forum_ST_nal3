<?php

require_once("model/UserDB.php");
require_once("ViewHelper.php");
require_once("Model/ForumDB.php");

class ForumController {

    public static function search(){
        if (isset($_GET["query"])) {
            $query = $_GET["query"];
            $hits = ForumDB::search($query);
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
}