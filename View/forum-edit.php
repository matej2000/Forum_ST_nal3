<?php 
    if(!isset($_SESSION["username"])) 
    { 
        ViewHelper::redirect(BASE_URL . "user/login");
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
    <?php include("View/import.php"); ?>
    <title>Add post</title>
</head>
<?php include("View/user-login-header.php"); ?>
<body>
    <div class="container">
        <h1>Edit post</h1>
        <div class="s">
            <div class="c">
                <h3 style="color:blue;">Category: <?=$category["name"] ?></h3>
                <form  action="<?= BASE_URL . "forum/edit" ?>" method="post">
                    <div class="inputs2">
                        <p><label>Title</label><br/><input type="text" name="title" value="<?=$post["title"]?>" required/> </p>
                        <p>
                            <label>Description: <br />
                            <textarea style="resize:none" name="content" rows="10" cols="40" required><?=$post["content"]?></textarea></label>
                        </p>
                        <input type="hidden" name="idc" value="<?=$category["idcategory"]?>">
                        <input type="hidden" name="idpost" value="<?=$post["idpost"]?>">
                        <input type="hidden" name="edit" value="1">
                    
                        <div class="c2">
                            <button class="btn btn-primary" type="submit">Post</button>
                        </div>
                    <div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>