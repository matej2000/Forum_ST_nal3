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

    public static function addPost(){
        $category = ForumDB::getCategory($_GET("idc"));
        ViewRender::render("View/forum-add.php", ["categry" => $category]);
    }

    public static function add(){
        if(isset($_GET["idc"])){
            $category = ForumDB::getCategory($_GET["idc"]);
            ViewHelper::render("View/forum-add.php", ["category" => $category]);
        }
        else{
            if(isset($_GET["query"])){
                $query = $_GET["query"];
                $hits = ForumDB::getCategories($_GET["query"]);
            }
            else{
                $query = "";
                $hits = [];
            }
            ViewHelper::render("View/forum-select-category.php", ["hits" => $hits, "query" => $query]);
        }
    }

    public static function post(){
        //TODO: doadaj post v podatkovno bazo, dodaj sesion, preverjanje uporabnika
        //ForumDB::insertPost($_GET["TitleC"], $_GET["DescriptionC"], $_GET[""]);
    }
}