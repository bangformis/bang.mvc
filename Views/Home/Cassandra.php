

<form id="form1" method="post" > 
    <textarea id="cql_content" name="cql_content" style="width:350px;height:150px;display: block;"><?php
        echo ResponseBag::Contains("CQL") ? ResponseBag::Get("CQL") : ""
        ?></textarea>
    <input type="submit" value="Execute CQL" class="btn btn-danger" />
</form>

<?php
if (ResponseBag::Contains("CqlResult")) {
    $result = ResponseBag::Get("CqlResult");
    var_dump($result);
}
