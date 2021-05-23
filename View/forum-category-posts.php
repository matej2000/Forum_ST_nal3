<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
    <?php include("View/import.php"); ?>
    <title>Search category</title>
</head>
<?php if(isset($_SESSION["username"])){
        include("View/user-login-header.php");
    }
    else{
        include("View/user-notlogin-header.php");
    }
?>
<body>
<div class="container">
        <div class="search">
            <form action="<?= BASE_URL . "forum/category" ?>" method="get">
                <input type="text" name="query" id="query" value="<?= $query ?>" />
                <input type="hidden" name="idc" value="<?= $category["IdC"]?>"/>
                <button>Search</button>
            </form>
        </div>
        <h1>Category: <?=$category["TitleC"] ?></h1>
        <div class="posts">
            <?php foreach ($hits as $forumPost): ?>
                <div class="post">
                    <a href="<?= BASE_URL . "forum?id=" . $forumPost["IdPost"] ?>"><?= $forumPost["Title"] ?></a>
                    <p><?php
                        if(strlen($forumPost["Content"]) <=255){
                            echo $forumPost["Content"];
                        }
                        else{
                            echo substr($forumPost["Content"],0,255) . " ...";
                        }
                    ?></p>
                    <div class="uppload-date">
                        <p><?= date("h:i d/m/Y",strtotime($forumPost["Date"])) ?></p>
                    </div>
                    <div class="user-name">

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
