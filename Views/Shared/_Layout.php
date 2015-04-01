<?php
$bodyView = ResponseBag::Get("View");
$viewBag = ViewBag::Get();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $viewBag->GetTitle() ?></title>
        <meta name="description" content="<?= $viewBag->Description ?>" />
        <link href="<?= Url::Content('Content/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= Url::Content('Content/bootstrap/css/bootstrap-theme.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="../../Content/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        include Path::Content("Views/Shared/_Layout/_Header.php");
        include Path::Content("Views/$bodyView");
        include Path::Content("Views/Shared/_Layout/_Footer.php");
        ?>
    </body>
</html>