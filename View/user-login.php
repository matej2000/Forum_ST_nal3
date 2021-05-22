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
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="<?= BASE_URL . "user/login" ?>" method="post">
        <p>
            <label>Username: <input type="text" name="username" autocomplete="off" 
                required autofocus /></label><br/>
            <label>Password: <input type="password" name="password" required /></label>
        </p>
        <p><button>Log-in</button></p>
    </form>

<?php if (isset($errorMessage)){
        echo $errorMessage;

    }?>
</body>
</html>