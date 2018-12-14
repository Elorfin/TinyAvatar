<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />

    <title>TinyMonsters demo</title>
    <meta name="description" content="" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
<h1>TinyMonsters demo</h1>

<?php

require_once 'autoload.php';

use Elorfin\TinyAvatar\TinyAvatar;

TinyAvatar::draw('monster', 'test@email.com');

?>

</body>
</html>
