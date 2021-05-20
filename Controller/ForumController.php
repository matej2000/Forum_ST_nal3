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
}