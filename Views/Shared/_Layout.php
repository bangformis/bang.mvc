<?php
$bodyView = ResponseBag::Get("View");
$viewBag = ViewBag::Get();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $viewBag->GetTitle() ?></title>
        <meta name="description" content="<?= $viewBag->Description ?>" />
        <link href="<?= Url::Content("Content/bootstrap/css/bootstrap.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= Url::Content("Content/css/site.css") ?>" rel="stylesheet" type="text/css"/>
        <script src="<?= Url::Content("Content/js/lib/jquery.js") ?>"></script>
    </head>
    <body>
        <div id="body">
            <?php require Path::Content("Views/Shared/_Layout/_Header.php"); ?>

            <div id="render_body">
                <?php require Path::Content("$bodyView"); ?>
            </div>

            <?php require Path::Content("Views/Shared/_Layout/_Footer.php"); ?>
        </div>

    </body>
</html>