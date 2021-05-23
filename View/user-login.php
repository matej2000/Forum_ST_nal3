<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
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
    <div class="container">
        <h1>Log-in</h1>
        <form action="<?= BASE_URL . "user/login" ?>" method="post">
            <div class="inputs">
                <p>
                    <p> <label>Username</label><br/>
                        <input type="text" name="username" autocomplete="off" required autofocus /><br/>
                    </p>
                    <p><label>Password</label><br/>
                        <input type="password" name="password" required pattern=".{8,}"/><br/>
                        <span class="important">
                            <?php
                                if(isset($errorMessage)){
                                    echo $errorMessage;
                                }
                            ?>
                        </span>
                    </p>
                </p>
                <div class="center">
                    <button class="btn btn-primary" type="submit">Log-in</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
