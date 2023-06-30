<?php
include 'config.php';

$foodcode = isset($_POST['foodcode']) ? $_POST['foodcode'] : '';
$foodname = isset($_POST['foodname']) ? $_POST['foodname'] : '';
$place    = isset($_POST['place'])    ? $_POST['place']    : '';
$visited  = isset($_POST['visited'])  ? $_POST['visited']  : '';
$rate     = isset($_POST['rate'])     ? $_POST['rate']     : '';
$picture  = isset($_POST['picture'])  ? $_POST['picture']  : '';
$intro    = isset($_POST['intro'])    ? $_POST['intro']    : '';
$remark   = isset($_POST['remark'])   ? $_POST['remark']   : '';


// 連接資料庫
$link = db_open();

// 寫出 SQL 語法
$sqlstr = "INSERT INTO food(foodcode, foodname, place, visited, rate, picture, intro, remark) VALUES ('$foodcode', '$foodname', '$place', '$visited', '$rate', '$picture', '$intro', '$remark') ";
// echo $sqlstr; exit;


// 執行 SQL
if(mysqli_query($link, $sqlstr))
{
   $new_uid = mysqli_insert_id($link);    // 傳回剛才新增記錄的 auto_increment 的欄位值
   
   $msg = '資料已新增!!!!!!!!<br/>';
   $msg .= '<a href="display.php?uid=' . $new_uid . '">詳細</a>';

   header('location: display.php?uid=' . $new_uid);
}
else
{
   $msg = '資料無法新增!!!!!!!!';
   $msg .= '<hr>' . $sqlstr . '<hr>' . mysqli_error($link);
}

db_close($link);


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>基本資料庫系統</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<p><a href="index.php">回首頁</a></p>

{$msg}
</body>
</html>
HEREDOC;

echo $html;
?>
