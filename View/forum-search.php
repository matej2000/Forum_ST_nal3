<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
?>
<body>
    <form action="<?= BASE_URL . "forum/search" ?>" method="get">
        <label for="query">Search:</label>
        <input type="text" name="query" id="query" value="<?= $query ?>" />
        <button>Search</button>
    </form>

    <ul>
        <?php foreach ($hits as $forumPost): ?>
            <li><a href="<?= BASE_URL . "forum?id=" . $forumPost["IdPost"] ?>"><?= $forumPost["Title"] ?>: 
                </a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>