<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
    <link rel="stylesheet" href="<?= CSS_URL . "headerStyle.css" ?>">
    <script type="text/javascript" src="<?= JS_URL . "uppvote.js" ?>"></script>
    <?php include("View/import.php"); ?>
    <title>Document</title>
</head>
<?php
    if(isset($_SESSION["username"])){
            include("View/user-login-header.php");
        }
    else{
            include("View/user-notlogin-header.php");
        }
        //if($likes[$key]){echo "uppvote(this)";}
?>

<body>
    <div class="container">
        <div class="search">
            <form action="<?= BASE_URL . "forum/search" ?>" method="get">
                <input type="text" name="query" id="query" value="<?= $query ?>" />
                <button>Search</button>
            </form>
        </div>
        <h1>Resoults</h1>
        <div class="posts">
            <?php foreach ($hits as $key => $forumPost): ?>
                <?php if($forumPost["removed"] == 0) : ?>
                    <div class="post">
                        <div class="vertical2">
                            <div class="vertical">
                                <span id="<?=$forumPost["idpost"]?>" class="<?php if($likes[$key]){echo "vote2";} else{echo "vote";}?>" onclick="like(this)"></span>
                            </div>
                            <div class="vertical">
                                <span id="p<?=$forumPost["idpost"]?>"> <?=$alllikes[$key]?></span>
                            </div>
                        </div>
                            
                        <a href="<?= BASE_URL . "forum?id=" . $forumPost["idpost"] ?>"><?= $forumPost["title"] ?></a>
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
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>