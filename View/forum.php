<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
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
        <h1>Wolcome to my forum!</h1>
        <h3>This is a general forum, ment for all types of questions. If you are interested, go ahead and ask a question.</h3>
        <div class="search">
            <form action="<?= BASE_URL . "forum/search" ?>" method="get">
                    <input type="text" name="query" id="query" value="<?= $query ?>" />
                    <button>Search</button>
            </form>
        </div>
    </div>
</body>
</html>