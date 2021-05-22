<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>
<body>
    <h2><?= $forum["Title"] ?></h2>
    <div>
        <p><?= $forum["Content"] ?> </p>
    </div>

    <div>
    <?php foreach ($comments as $comment): ?>
            <p><?= $comment["Content"] ?> </p>
    <?php endforeach; ?>
    </div>

</body>
</html>