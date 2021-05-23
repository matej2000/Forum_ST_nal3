<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "content.css" ?>">
    <?php include("View/import.php"); ?>
    <title>Forum</title>
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
        <div class="post">
            <h1><?= $forum["Title"] ?></h1>
            <div class="user">
                <p> <?= $author["UserName"] ?> </p>
            </div>
            <div>
                <p><?= $forum["Content"] ?> </p>
            </div>
            <div class="uppload-date">
                <p><?= date("h:i d/m/Y",strtotime($forum["Date"])) ?></p>
            </div>
        </div>
        <h2>Comments</h2>
        <div class="comments">
            <?php foreach($comments as $key => $comment):?>
                <div class="comment">
                    <div class="user">
                        <p><?= $usersc[$key]["UserName"] ?> </p>
                    </div>
                    <p><?= $comment["Content"] ?> </p>
                    <div class="uppload-date">
                        <p><?= date("h:i d/m/Y",strtotime($comment["Date"])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="center">
                <form action="<?= BASE_URL . "forum/comment" ?>" method="post">
                    <p><label>Add comment</label></br> 
                    <textarea style="resize:none" name="content" rows="10" cols="40" required></textarea></p>
                    <input type="hidden" name="IdC" value="<?= $forum["IdC"] ?>"/>
                    <input type="hidden" name="Pos_IdPost" value="<?= $forum["IdPost"] ?>"/>
                    <input type="hidden" name="Id" value="<?= $forum["Id"] ?>"/>
                    <button class="btn btn-primary" type="submit">Comment</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>