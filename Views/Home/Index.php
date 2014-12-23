<?php
echo ResponseBag::Get("Index1");
//$allOperators = (new Operator())->GetList();
?>

<a href="<?= Url::Action("Index2") ?>"> Index 2 </a>

<div>
    <input type="button" value="TestJson" id="TestJson" />
</div>



<script>
    $(function() {
        $("#TestJson").click(function() {
            $.post("<?= Url::Action("JsonTest") ?>", {id: '9644208', password: "123456", name: "Bang", permission: 9}, function(data) {
                console.log(data);
            });
        });
    });
</script>
