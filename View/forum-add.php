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
    <?php include("View/import.php"); ?>
    <title>Add post</title>
</head>
<?php include("View/user-login-header.php"); ?>
<body>
    <h1>Add post</h1>
    <h2>Category: <?=$category["TitleC"] ?></h2>
    <form  action="<?= BASE_URL . "forum/add" ?>" method="post">
        <p><label>Title: <input type="text" name="title" required/> </label></p>
        <p>
            <label>Description: <br />
            <textarea style="resize:none" name="content" rows="10" cols="40" required></textarea></label>
	    </p>
        <input type="hidden" name="idc" value="<?=$category["IdC"]?>">
        <p><button>Post</button></p>
    </form>
</body>
</html>