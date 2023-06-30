<?php

$today = date('Y-m-d', time());


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
<h2 align="center">新增資料</h2>

<form action="add_save.php" method="post">
  <p>代碼：<input type="text" name="foodcode"></p>
  <p>名稱：<input type="text" name="foodname"></p>
  <p>地點：<input type="text" name="place"></p>
  <p>拜訪日期：<input type="text" name="visited" value="{$today}" readonly></p>
  <p>評分：<input type="text" name="rate"></p>
  <p>圖片：<input type="text" name="picture"></p>
  <p>說明：
  <textarea name="intro" rows="5" cols="40"></textarea>
  </p>
  <p>備註：<input type="text" name="remark"></p>
  <input type="submit" value="新增">
</form>
 
</body>
</html>
HEREDOC;

echo $html;
?>
