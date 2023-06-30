<?php
include 'config.php';

$uid = isset($_POST['uid']) ? $_POST['uid']  : '';

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

$sqlstr  = "UPDATE food SET ";
$sqlstr .= "foodcode='$foodcode', ";
$sqlstr .= "foodname='$foodname', ";
$sqlstr .= "place   ='$place' , ";
$sqlstr .= "visited ='$visited', ";
$sqlstr .= "rate    ='$rate'  , ";
$sqlstr .= "picture ='$picture'  , ";
$sqlstr .= "intro   ='$intro'  , ";
$sqlstr .= "remark  ='$remark' ";  // 注意最後欄位沒有逗號
$sqlstr .= "WHERE uid=" . $uid;
// echo $sqlstr; exit;

if(mysqli_query($link, $sqlstr))
{
   $msg = '資料已修改完畢!!!!!!!!';
   $msg .= '<br><a href="display.php?uid=' . $uid . '">詳細</a>';
   header('location: display.php?uid=' . $uid);
}
else
{
   $msg = '資料無法修改!!!!!!!';
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
