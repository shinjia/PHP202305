<?php
// 含分頁之資料列表
include 'config.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;   // 目前的頁碼

$numpp = 5; // 每頁的筆數


// 連接資料庫
$link = db_open();


// 擷取該分頁資料
$tmp_start = ($page-1) * $numpp;  // 從第幾筆記錄開始抓取資料

$sqlstr = "SELECT * FROM food ";
$sqlstr .= " LIMIT " . $tmp_start . "," . $numpp;
// echo $sqlstr; exit;

$result = mysqli_query($link, $sqlstr);

$data = '';
while($row=mysqli_fetch_array($result))
{
   $uid      = $row['uid'];
   $foodcode = $row['foodcode'];
   $foodname = $row['foodname'];
   $place    = $row['place'];
   $visited  = $row['visited'];
   $rate     = $row['rate'];
   $picture  = $row['picture'];
   // $intro    = $row['intro'];
   $remark   = $row['remark'];
   
   // 依需要調整顯示內容


   $data .= <<< HEREDOC
   <tr>
     <td>{$uid}</td>
     <td>{$foodcode}</td>
     <td>{$foodname}</td>
     <td>{$place}</td>
     <td>{$visited}</td>
     <td>{$rate}</td>
     <td>{$picture}</td>
     <td>{$remark}</td>
     <td><a href="display.php?uid={$uid}">詳細</a></td>
     <td><a href="edit.php?uid={$uid}">修改</a></td>
     <td><a href="delete.php?uid={$uid}" onclick="return confirm('確定要刪除嗎？');">刪除</a></td>
   </tr>
HEREDOC;
}


// 處理分頁、頁碼資料
$sqlstr = "SELECT count(*) as total_rec FROM food ";
$result = mysqli_query($link, $sqlstr);

if($row=mysqli_fetch_array($result))
{
   $total_rec = $row["total_rec"];
   // $total_rec = mysqli_num_rows($result);  // 計算總筆數
}
$total_page = ceil($total_rec / $numpp);  // 計算總頁數
   

// 分頁之超連結
$navigator = "";

// for($i=1; $i<=$total_page-1; $i++)
// {
//    $navigator .= "<a href=\"?page=" . $i . "\">" . $i . "</a>&nbsp;";
// }

// $navigator .= '<hr>';

for($i=1; $i<=$page-1; $i++)
{
   $navigator .= "<a href=\"?page=" . $i . "\">" . $i . "</a>&nbsp;";
}
$navigator .= "[" . $i . "]&nbsp;";
for($i=$page+1; $i<=$total_page; $i++)
{
   $navigator .= "<a href=\"?page=" . $i .  "\">" . $i . "</a>&nbsp;";
}

$lnk_pageprev  = "?page=" . (($page==1)?(1):($page-1));
$lnk_pagenext  = "?page=" . (($page==$total_page)?($total_page):($page+1));
$lnk_pagefirst = "?page=1";
$lnk_pagelast  = "?page=" . $total_page;


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
<h2 align="center">共有 $total_rec 筆記錄</h2>
<table border="0" align="center">
   <tr> 
      <td colspan="30">{$navigator}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pages: {$page} / {$total_page} &nbsp;&nbsp;&nbsp;
        <a href="{$lnk_pagefirst}">第一頁</a>&nbsp;
        <a href="{$lnk_pageprev}">上一頁</a>&nbsp;
        <a href="{$lnk_pagenext}">下一頁</a>&nbsp;
        <a href="{$lnk_pagelast}">最末頁</a>&nbsp;
      </td>
   </tr>
</table>

<table border="1" align="center">   
   <tr>
      <th>序號</th>
      <th>代碼</th>
      <th>名稱</th>
      <th>地點</th>
      <th>拜訪日期</th>
      <th>評分</th>
      <th>圖片</th>
      <th>備註</th>
      <th colspan="3" align="center">操作 [<a href="add.php">新增記錄</a>]</td>
   </tr>
{$data}
</table>
</body>
</html>
HEREDOC;

echo $html;
?>