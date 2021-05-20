<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= BASE_URL . "forum/search" ?>" method="get">
        <label for="query">Search:</label>
        <input type="text" name="query" id="query" value="<?= $query ?>" />
        <button>Search</button>
    </form>

    <ul>
        <?php foreach ($hits as $forumPost): ?>
            <li><a href="<?= BASE_URL . "book?id=" . $forumPost["IdPost"] ?>"><?= $forumPost["Title"] ?>: 
                </a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>