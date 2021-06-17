<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
    <script type="text/javascript" src="<?= JS_URL . "uppvote.js" ?>"></script>
    <?php include("View/import.php"); ?>
    <title>My posts</title>
</head>
<?php 
    include("View/user-login-header.php");
?>
<body>
<div class="container">
        <div class="search">
            <form action="<?= BASE_URL . "forum/search" ?>" method="get">
                <input type="text" name="query" id="query" value="<?= $query ?>" />
                <button>Search</button>
            </form>
        </div>
        <h1>My posts</h1>
        <div class="posts">
            <?php foreach ($hits as $key => $forumPost): ?>
                <div class="post">
                    <div class="vertical2">
                        <div class="vertical">
                            <span id="<?=$forumPost["idpost"]?>" class="<?php if($likes[$key]){echo "vote2";} else{echo "vote";}?>" onclick="like(this)"></span>
                        </div>
                        <div class="vertical">
                            <span id="p<?=$forumPost["idpost"]?>"> <?=$alllikes[$key]?></span>
                        </div>
                    </div>
                    <a href="
                        <?php 
                            if($forumPost["post_idpost"] != null){
                                echo BASE_URL . "forum?id=" . $forumPost["post_idpost"];
                            }
                            else{
                                echo BASE_URL . "forum?id=" . $forumPost["idpost"];
                            }
                        ?>
                    ">
                        <?php 
                            if($forumPost["post_idpost"] != null){
                                echo "Comment: ";
                            }
                            else{
                                echo $forumPost["title"];
                            }
                        ?>
                    </a>
                    <p><?php
                        if(strlen($forumPost["content"]) <=255){
                            echo $forumPost["content"];
                        }
                        else{
                            echo substr($forumPost["content"],0,255) . " ...";
                        }
                    ?></p>
                    <div class="uppload-date">
                        <p><?= date("h:i d/m/Y",strtotime($forumPost["time"])) ?></p>
                    </div>
                    <div class="user-name">

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

