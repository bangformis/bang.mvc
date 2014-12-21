<?php
echo ResponseBag::Get("Index1");
?>

<a href="<?= Url::Action("Index2") ?>"> Index 2 </a>

<div>
    <input type="button" value="TestJson" id="TestJson" />
</div>

<script>
    $(function () {
        $("#TestJson").click(function () {
            $.post("<?= Url::Action("JsonTest") ?>", {UserName: 'Bang@cycu.org.tw', Password: "123456"}, function (data) {
                console.log(data);
            });
        });
    });
</script>
