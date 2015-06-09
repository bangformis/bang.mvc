<?php
$bodyView = ResponseBag::Get("View");
$viewBag = ViewBag::Get();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $viewBag->GetTitle() ?></title>
        <meta name="description" content="<?= $viewBag->Description ?>" />
		<?php
		Bundle::Css('test_css', array(
            'Content/bootstrap/css/bootstrap.css',
            'Content/bootstrap/css/bootstrap-theme.css'
        ));
		Bundle::Js('test_js', array(
            'Content/js/lib/jquery.js',
            'Content/bootstrap/js/bootstrap.js'
        ));
		?>
    </head>
    <body>
        <?php
        include Path::Content("Views/Shared/_Layout/_Header.php");
        include Path::Content("Views/$bodyView");
        include Path::Content("Views/Shared/_Layout/_Footer.php");
        ?>
    </body>
</html>