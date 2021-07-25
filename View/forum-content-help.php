<?php
class contentHelp{

    public static function publicPost($forum, $author, $foruml, $forumlc){


        include("Content-visibility/forum-content-public.php");
    }

    public static function privatePost($forum, $author, $foruml, $forumlc){
        include("Content-visibility/forum-content-private.php");
    }

    public static function publicPostComment($forum, $author, $foruml, $forumlc){
        include("Content-visibility/forum-content-public-comment.php");
    }

    public static function privatePostComment($forum, $author, $foruml, $forumlc){
        include("Content-visibility/forum-content-public-comment.php");
    }

}

?>