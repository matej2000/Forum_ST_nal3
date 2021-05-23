<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("View/import.php"); ?>
    <title>Document</title>
</head>
<?php include("View/user-login-header.php") ?>
<body>
    
    <div class="container">
        <div style="text-align:center;">
            <h1>Welcome back <?=$_SESSION["username"]?></h1>
        </div>
    </div>

</body>
</html>