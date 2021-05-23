<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("View/import.php"); ?>
    <title>Forum</title>
    <?php include("View/import.php"); ?>
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
    <form action="<?= BASE_URL . "forum/search" ?>" method="get">
            <label for="query">Search:</label>
            <input type="text" name="query" id="query" value="<?= $query ?>" />
            <button>Search</button>
    </form>
</div>
</body>
</html>