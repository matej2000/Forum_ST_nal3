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
        require_once("View/forum-content-help.php");
        
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
        ViewHelper::redirect(BASE_URL . "forum?id=" . $forum["post_idpost"]);
    }

?>
<body>
    <div class="container">
        <div class="post">
            <?php if($forum["removed"] == 1){
                if($forum["user_iduser"] != end($_SESSION["id"])){
                    echo "<h1>This post has been made private.";
                }
                else{
                    contentHelp::privatePost($forum, $author, $foruml, $forumlc);
                }
            }
            else{
                contentHelp::publicPost($forum, $author, $foruml, $forumlc);
            }?>
        
            <?php if($forum["user_iduser"] == end($_SESSION["id"]) || $forum["removed"] == 0) : ?> 
                <h2>Comments</h2>
                <div class="comments">
                    <?php foreach($comments as $key => $comment):?>
                        <?php if($comment["removed"] == 1){
                            if($comment["user_iduser"] == end($_SESSION["id"])){
                                contentHelp::privatePostComment($comment, $usersc[$key], $commentsl[$key], $commentslc[$key]);
                                
                            }
                        }
                        else{
                            contentHelp::publicPostComment($comment, $usersc[$key], $commentsl[$key], $commentslc[$key]);
                        }?>
                    
                    <?php endforeach; ?>
                </div>
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
            <?php endif; ?>
        </div>
    </div>

</body>
</html>