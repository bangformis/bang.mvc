<?php
echo ResponseBag::Get("Index1");
$allOperators = (new Operator())->GetList();
?>

<a href="<?= Url::Action("Index2") ?>"> Index 2 </a>

<div>
    <input type="button" value="TestJson" id="TestJson" />
</div>

<?php
foreach ($allOperators as $operator) {
    $operator = Operator::ChangeType($operator);
    ?>
    <div>
        <?= $operator->name ?>

    </div>
    <?php
}
?>


<script>
    $(function () {
        $("#TestJson").click(function () {
            $.post("<?= Url::Action("JsonTest") ?>", {UserName: 'Bang@cycu.org.tw', Password: "123456"}, function (data) {
                console.log(data);
            });
        });
    });
</script>
