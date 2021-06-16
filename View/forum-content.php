<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "content.css" ?>">
    <script type="text/javascript" src="<?= JS_URL . "uppvote.js" ?>"></script>
    <?php 
        include("View/import.php"); 
        
    ?>
    <title>Forum</title>
</head>
<?php if(isset($_SESSION["username"])){
        include("View/user-login-header.php");
    }
    else{
        include("View/user-notlogin-header.php");
    }

    if($forum["post_idpost"] != null){
        echo "dela";
        ViewHelper::redirect(BASE_URL . "forum?id=" . $forum["post_idpost"]);
    }

?>
<body>
    <div class="container">
        <div class="post">
            <h1><?= $forum["title"] ?></h1>
            <div class="user">
                <p> <?php 
                    if(is_array($author)){
                        echo $author["username"];
                    }
                    ?> 
                    <div class="vertical2">
                        <div class="vertical">
                            <span id="<?=$forum["idpost"]?>" class="<?php if($foruml){echo "vote2";} else{echo "vote";}?>" onclick="like(this)"></span>
                        </div>
                        <div class="vertical">
                            <span id="p<?=$forum["idpost"]?>"> <?=$forumlc?></span>
                        </div>
                    </div>
                </p>
            </div>
            <div>
                <p><?= $forum["content"] ?> </p>
            </div>
            <div class="uppload-date">
                <!-- popravi to da dela -->
                
                <p><?= date("h:i d/m/Y",strtotime($forum["time"])) ?></p>
            </div>
        </div>
        <h2>Comments</h2>
        <div class="comments">
            <?php foreach($comments as $key => $comment):?>
                <div class="comment">
                    <div class="user">
                        <p><?= $usersc[$key]["username"] ?>
                        <div class="vertical2">
                            <div class="vertical">
                                <span id="<?=$comment["idpost"]?>" class="<?php if($commentsl[$key]){echo "vote2";} else{echo "vote";}?>" onclick="like(this)"></span>
                            </div>
                            <div class="vertical">
                                <span id="p<?=$comment["idpost"]?>"> <?=$commentslc[$key]?></span>
                            </div>
                        </div>
                    </p>
                    </div>
                    <p><?= $comment["content"] ?> </p>
                    <div class="uppload-date">
                        <p><?= date("h:i d/m/Y",strtotime($comment["time"])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="center">
                <form action="<?= BASE_URL . "forum/comment" ?>" method="post">
                    <p><label>Add comment</label></br> 
                    <textarea style="resize:none" name="content" rows="10" cols="40" required></textarea></p>
                    <input type="hidden" name="IdC" value="<?= $forum["idcategory"] ?>"/>
                    <input type="hidden" name="Pos_IdPost" value="<?= $forum["idpost"] ?>"/>
                    <input type="hidden" name="Id" value="<?= $forum["userid"] ?>"/>
                    <button class="btn btn-primary" type="submit">Comment</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>