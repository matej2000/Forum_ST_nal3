<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
    <?php include("View/import.php"); ?>
    <title>Select category</title>
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
<div class="container">
        <div class="search">
            <form action="<?= BASE_URL . "forum/add" ?>" method="get">
                <input type="text" name="query" id="query" value="<?= $query ?>" />
                <button>Search</button>
            </form>
        </div>
        <h1>Select category</h1>
        <div class="posts">
            <form action="<?= BASE_URL . "forum/addcategory" ?>" method="get">
                <button>New category</button>
            </form>
            <?php foreach ($hits as $category): ?>
                <div class="post">
                <a href="<?= BASE_URL . "forum/add?idc=" . $category["idcategory"] ?>"><?= $category["name"] ?></a>
                    <p><?php
                        if(strlen($category["description"]) <=255){
                            echo $category["description"];
                        }
                        else{
                            echo substr($category["description"],0,255) . " ...";
                        }
                    ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
