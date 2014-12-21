<?php
$bodyView = ResponseBag::Get("View");
$viewBag = ViewBag::Get();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $viewBag->GetTitle() ?></title>
        <meta name="description" content="<?= $viewBag->Description ?>" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    </head>
    <body>
        <?php
        include Url::Content("VIews/Shared/_Layout/_Header.php");

        include "$bodyView";

        include Url::Content("VIews/Shared/_Layout/_Footer.php");
        ?>
    </body>
</html>