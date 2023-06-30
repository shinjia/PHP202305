<?php
include 'config.php';

$uid = isset($_GET['uid']) ? $_GET['uid'] : 0;

// 連接資料庫
$link = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM food WHERE uid=" . $uid;
// echo $sqlstr; exit;

// 執行 SQL
$result = mysqli_query($link, $sqlstr);
// mysqli_fetch_row()
// mysqli_fetch_assoc()
// echo '<pre>';
// print_r($row); 
// echo '</pre>';
// exit;

if($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
   $uid      = $row['uid'];
   $foodcode = $row['foodcode'];
   $foodname = $row['foodname'];
   $place    = $row['place'];
   $visited  = $row['visited'];
   $rate     = $row['rate'];
   $picture  = $row['picture'];
   $intro    = $row['intro'];
   $remark   = $row['remark'];

   // 部分顯示修改
   $str_intro = nl2br($intro);
   
   // 圖片
   $filename = 'photo/' . $picture;
   // 要檢查 (1)欄位有資料及 (2)檔案確實存在
   if(!empty($picture) && file_exists($filename)) {
      $str_picture = '<img src="' . $filename . '">';
   }
   else {
      $str_picture = '**無圖片**';
   }


   $data = <<< HEREDOC
   <table border="1">
      <tr>
        <th>代碼</th>
        <td>{$foodcode}</td>
      </tr>
      <tr>
        <th>名稱</th>
        <td>{$foodname}</td>
      </tr>
      <tr>
        <th>地點</th>
        <td>{$place}</td>
      </tr>
      <tr>
        <th>拜訪日期</th>
        <td>{$visited}</td>
      </tr>
      <tr>
        <th>評分</th>
        <td>{$rate}</td>
      </tr>
      <tr>
        <th>圖片</th>
        <td>{$picture} {$str_picture}</td>
      </tr>
      <tr>
        <th>說明</th>
        <td>{$str_intro}</td>
      </tr>
      <tr>
        <th>備註</th>
        <td>{$remark}</td>
      </tr>
    </table>
HEREDOC;
}
else
{
  $data = '找不到資料！';
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

<h2>詳細資料</h2>

{$data}

</body>
</html>
HEREDOC;

echo $html;
?>
