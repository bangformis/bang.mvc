<?php

require_once 'System.php';

//$money = rand(100, 700);
//$model = new bang_model();
//$model->text1 = 'test1';
//$model->text2 = 'test2';
//$model->money = $money;
//$model->Insert();

//$result = MySqlTable::GetSingle("bang_model", "WHERE id=1");
//$result = bang_model::AsType($result);
//$result->text1 = "測試修改UPDATE555";
//$result->Update();

$result = MySqlTable::GetSingle("bang_model", "WHERE id=2");
$result = bang_model::AsType($result);
$result->Delete();