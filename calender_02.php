<?php

// =================== データベースへの書き込み

ini_set('display_errors', 1);

require(dirname(__FILE__) . "/functions.php");

if (isset($_POST['name'])) {

    $name = H_chars($_POST['name']); // 名前
    $number = H_chars($_POST['number']); // 電話場合
    $member = H_chars($_POST['member']); // 人数
    $day = H_chars($_POST['day']);  // 日付
}

$dataInsert = [
    'name' => $name,
    'number' => $number,
    'member' => $member,
    'day' => $day
];


// === インサート処理
$Mysql_Go = new Mysql_Go();
$Mysql_Go->Insert_Data('t_calendar_tb_01', $dataInsert);

// === select 
$get_select_arr = $Mysql_Go->Get_Select_Member('t_calendar_tb_01');

var_dump($get_select_arr);
