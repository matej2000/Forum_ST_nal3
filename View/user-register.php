<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "main.css" ?>">
    <?php include("View/import.php"); ?>
    <title>Register</title>
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
        <h1>Register</h1>
        <form action="<?= BASE_URL . "user/register" ?>" method="post">
            <div class="inputs">
                <p>
                    <p> <label>Username</label><br/>
                        <input type="text" name="username" autocomplete="off" required autofocus /><br/>
                    </p>
                    <p> <label>Email</label><br/>
                        <input type="email" name="email" required /><br/>
                        <span class="important"><?= $errors["exist"] ?></span>
                    </p>
                    <p><label>Birthday</label><br/>
                        <input type="date" name="birthday" required min="1900-01-01" max="<?= date("Y-m-d") ?>"><br/>
                        <span class="important"><?= $errors["birthday"] ?></span>
                    </p>
                    <p><label>Password</label><br/>
                        <input type="password" name="password" required pattern=".{8,}"/><br/>
                        <span class="important"><?= $errors["password"] ?></span>
                    </p>
                </p>
                <div class="center">
                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>