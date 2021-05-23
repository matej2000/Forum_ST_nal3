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
    <?php include("View/user-login-header.php") ?>
    <h1>Nevem se kaj bo to</h1>
    <?php echo $_SESSION["username"]?>
</body>
</html>