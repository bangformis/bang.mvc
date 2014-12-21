<?php
$bodyView = ResponseBag::Get("View");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test2</title>
    </head>
    <body>
        <?php
        include Url::Content("VIews/Shared/_Layout/_Header.php");

        include "$bodyView";

        include Url::Content("VIews/Shared/_Layout/_Footer.php");
        ?>
    </body>
</html>