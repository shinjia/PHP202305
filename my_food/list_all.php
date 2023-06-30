<?php
include 'config.php';

// 連接資料庫
$link = db_open();


$sqlstr = "SELECT * FROM food ";

$result = mysqli_query($link, $sqlstr);

$total_rec = mysqli_num_rows($result);

// $cnt = 0;
$data = '';
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
   // $cnt++;

   $uid      = $row['uid'];
   $foodcode = $row['foodcode'];
   $foodname = $row['foodname'];
   $place    = $row['place'];
   $visited  = $row['visited'];
   $rate     = $row['rate'];
   $picture  = $row['picture'];
   $intro    = $row['intro'];
   $remark   = $row['remark'];
   
   // 依需要調整顯示內容
   $str_visited = date('Y-m-d', strtotime($visited));

   $str_intro = nl2br($intro);

   // 圖片
   $filename = 'photo/' . $picture;
   // 要檢查 (1)欄位有資料及 (2)檔案確實存在
   if(!empty($picture) && file_exists($filename)) {
      $str_picture = '<img src="' . $filename . '" style="max-width:150px;">';
   }
   else {
      // 顯示文字
      $str_picture = '**無圖片**';
      // 預設空圖片
      $str_picture = '<img src="photo/00default.png" style="max-width:150px;">';
   }

   

   $data .= <<< HEREDOC
   <tr>
     <td>{$uid}</td>
     <td>{$foodcode}</td>
     <td>{$foodname}</td>
     <td>{$place}</td>
     <td>{$str_visited}</td>
     <td>{$rate}</td>
     <td>{$str_picture}</td>
     <td>{$str_intro}</td>
     <td>{$remark}</td>
     <td><a href="display.php?uid={$uid}">詳細</a></td>
     <td><a href="edit.php?uid={$uid}">修改</a></td>
     <td><a href="delete.php?uid={$uid}" onclick="return confirm('確定要刪除嗎？');">刪除</a></td>
   </tr>
HEREDOC;
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
<h2 align="center" align="center">共有 {$total_rec} 筆記錄</h2>
<table border="1" align="center">
   <tr>
      <th>序號</th>
      <th>代碼</th>
      <th>名稱</th>
      <th>地點</th>
      <th>拜訪日期</th>
      <th>評分</th>
      <th>圖片</th>
      <th>說明</th>
      <th>備註</th>
      <td colspan="3" align="center">操作 [<a href="add.php">新增記錄</a>]</td>
   </tr>
{$data}
</table>

</body>
</html>
HEREDOC;

echo $html;
?>