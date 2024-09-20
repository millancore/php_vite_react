<?php

use App\Vite\ViteManager;

include '../bootstrap.php';

$vite = new ViteManager(APP_ROOT.'/public/dist');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP [Vite + React]</title>
    <link rel="stylesheet" href="<?= $vite->get('view/css/index.css') ?>">
    <link rel="stylesheet" href="<?= $vite->styles('view/entries/custom-calendar.jsx') ?>">
</head>
<body>
    <div id="calendar"></div>
    <?= $vite->addReactRefresh() ?>
    <script type="module" src="<?= $vite->get('view/entries/custom-calendar.jsx') ?>"></script>
</body>
</html>