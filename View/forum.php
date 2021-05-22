<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>
<body>
<p>[
<a href="<?= BASE_URL . "forum" ?>">Forum</a> |
<a href="<?= BASE_URL . "forum/search" ?>">Search</a> |
<a href="<?= BASE_URL . "forum/add" ?>">Add new</a> |
<a href="<?= BASE_URL . "user/login" ?>">Log-in</a>
]</p>

    <form action="<?= BASE_URL . "forum/search" ?>" method="get">
            <label for="query">Search:</label>
            <input type="text" name="query" id="query" value="<?= $query ?>" />
            <button>Search</button>
    </form>
</body>
</html>