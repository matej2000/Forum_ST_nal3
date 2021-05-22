<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select category</title>
</head>
<body>
<form action="<?= BASE_URL . "forum/add" ?>" method="get">
        <label for="query">Search:</label>
        <input type="text" name="query" id="query" value="<?= $query ?>" />
        <button>Search</button>
    </form>
    <ul>
        <?php foreach ($hits as $category): ?>
            <li><a href="<?= BASE_URL . "forum/add?idc=" . $category["IdC"] ?>"><?= $category["TitleC"] ?>: <?=$category["DescriptionC"]?>
                </a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>