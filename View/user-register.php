<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="<?= BASE_URL . "user/register" ?>" method="post">
    <p>
        <label>Username: <input type="text" name="username" autocomplete="off" 
            required autofocus /></label><br/>
        <label>Email <input type="email" name="email" required /></label><br>
        <label>Birthday <input type="date" name="birthday" required min="1900-01-01" max="<?= date("Y-m-d") ?>"></label><br>
        <label>Password: <input type="password" name="password" required pattern=".{8,}"/></label>
    </p>
    <p><button>Register</button></p>
</form>
</body>
</html>