

<div style="width:1000px; height: 1000px; margin:auto;">

    <?php 
        $paging = new Pagination(100, 2, 20);
        $paging->ShowModule(Url::Action('Index'));
    ?>

</div>
