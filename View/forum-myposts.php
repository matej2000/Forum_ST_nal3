<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("View/import.php"); ?>
    <title>My posts</title>
</head>
<?php 
    include("View/user-login-header.php");
?>
<body>
<form action="<?= BASE_URL . "forum/myposts" ?>" method="get">
        <label for="query">Search:</label>
        <input type="text" name="query" id="query" value="<?= $query ?>" />
        <button>Search</button>
    </form>
    <ul>
        <?php foreach ($hits as $hit): ?>
            <li><a href="
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
            <?= $hit["Title"] ?>: <?=$hit["Content"]?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>