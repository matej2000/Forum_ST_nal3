<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My posts</title>
</head>
<body>
<form action="<?= BASE_URL . "forum/myposts" ?>" method="get">
        <label for="query">Search:</label>
        <input type="text" name="query" id="query" value="<?= $query ?>" />
        <button>Search</button>
    </form>
    <ul>
        <?php foreach ($hits as $hit): ?>
            <li><a href="<?= BASE_URL . "forum?id=" . $hit["IdPost"] ?>"><?= $hit["Title"] ?>: <?=$hit["Content"]?>
                </a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>