<?php
    include '../bootstrap.php';

    $vite = new \App\Vite\ViteComponentLoader(APP_ROOT.'/public/dist/.vite');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP [Vite + React]</title>
    <link rel="stylesheet" href="dist/assets/tailwind-CfiLjM7Z.css">
    <link rel="stylesheet" href="<?= $vite->styles('custom_calendar') ?>">
</head>
<body>
    <div id="calendar"></div>
    <?= $vite->addReactRefresh() ?>
    <script type="module" src="<?= $vite->component('custom_calendar') ?>"></script>
</body>
</html>