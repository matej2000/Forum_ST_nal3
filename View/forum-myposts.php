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
                            if($hit["Pos_IdPost"] != null){
                                echo BASE_URL . "forum?id=" . $hit["Pos_IdPost"];
                            }
                            else{
                                echo BASE_URL . "forum?id=" . $hit["IdPost"];
                            }
                        ?>
                    ">
                        <?php 
                            if($hit["Pos_IdPost"] != null){
                                echo "Comment: ";
                            }
                        ?>
                        <?= $hit["Title"] ?>
                    </a>
                    <p><?php
                        if(strlen($hit["Content"]) <=255){
                            echo $hit["Content"];
                        }
                        else{
                            echo substr($hit["Content"],0,255) . " ...";
                        }
                    ?></p>
                    <div class="uppload-date">
                        <p><?= date("h:i d/m/Y",strtotime($hit["Date"])) ?></p>
                    </div>
                    <div class="user-name">

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

