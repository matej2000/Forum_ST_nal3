<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
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
            <?php foreach ($hits as $hit): ?>
                <div class="post">
                    <a href="
                        <?php 
                            if($hit["post_idpost"] != null){
                                echo BASE_URL . "forum?id=" . $hit["post_idpost"];
                            }
                            else{
                                echo BASE_URL . "forum?id=" . $hit["idpost"];
                            }
                        ?>
                    ">
                        <?php 
                            if($hit["post_idpost"] != null){
                                echo "Comment: ";
                            }
                            else{
                                echo $hit["title"];
                            }
                        ?>
                    </a>
                    <p><?php
                        if(strlen($hit["content"]) <=255){
                            echo $hit["content"];
                        }
                        else{
                            echo substr($hit["content"],0,255) . " ...";
                        }
                    ?></p>
                    <div class="uppload-date">
                        <p><?= date("h:i d/m/Y",strtotime($hit["time"])) ?></p>
                    </div>
                    <div class="user-name">

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

