<?php
include 'config.php';
include 'define.php';

$uid = isset($_GET['uid']) ? $_GET['uid'] : 0;



// 連接資料庫
$link = db_open();

$sqlstr = "SELECT * FROM food WHERE uid=" . $uid;
$result = mysqli_query($link, $sqlstr);

if($row=mysqli_fetch_array($result))
{
   $uid      = $row['uid'];
   $foodcode = $row['foodcode'];
   $foodname = $row['foodname'];
   $place    = $row['place'];
   $visited  = $row['visited'];
   $rate     = $row['rate'];
   $picture  = $row['picture'];
   $intro    = $row['intro'];
   $kind     = $row['kind'];
   $price    = $row['price'];
   $star     = $row['star'];
   $remark   = $row['remark'];


   // 處理『kind』欄位的 SELECT..OPTION 選項
   $select_kind = '<select name="kind">';
   foreach($a_kind as $key=>$value)
   {
      $str_selected = ($kind==$key) ? ("selected") : ("");
      $select_kind .= '<option value="' . $key . '" ' . $str_selected . '>' . $value . '</option>';
   }
   $select_kind .= '</select>';
   
   // 處理『price』欄位的 RADIO 選項
   $radio_price = '';
   foreach($a_price as $key=>$value)
   {
   $str_checked = ($price==$key) ? ("checked") : ("");
      $radio_price .= '<input type="radio" name="price" value="' . $key . '" ' . $str_checked . '>' . $value;
   }

   // 處理『star』欄位的 Checkbox 選項
   $checkbox_star = '';
   $str_checked = (isset($a_star[$star])) ? ("checked") : ("");
   foreach($a_star as $key=>$value)
   {
      $checkbox_star .= '<input type="checkbox" name="star" value="' . $key . '" ' . $str_checked . ' />' . $value;
   }

   $data = <<< HEREDOC
   <form action="edit_save.php" method="post">
      <p>代碼：<input type="text" name="foodcode" value="{$foodcode}"></p>
      <p>名稱：<input type="text" name="foodname" value="{$foodname}"></p>
      <p>地點：<input type="text" name="place"  value="{$place}"></p>
      <p>拜訪日期：<input type="date" name="visited" value="{$visited}"></p>
      <p>評分：<input type="text" name="rate"   value="{$rate}"></p>
      <p>圖片：<input type="text" name="picture"   value="{$picture}"></p>
      <p>說明：<textarea name="intro" rows="4" cols="40">{$intro}</textarea></p>

      <p>分類：{$select_kind}</p>
      <p>價位：{$radio_price}</p>
      <p>推薦：{$checkbox_star}</p>

      <p>備註：<input type="text" name="remark"   value="{$remark}"></p>

      <input type="hidden" name="uid" value="{$uid}">
      <input type="submit" value="送出">
   </form>
HEREDOC;
}
else
{
   $data = '找不到資料';
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

<h2 align="center">修改資料</h2>

{$data}

</body>
</html>
HEREDOC;

echo $html;
?>
