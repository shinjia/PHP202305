<?php
// 連接資料庫
$link = mysqli_connect('localhost', 'root', '', 'class');

// 寫出 SQL 語法 
$sqlstr = "
INSERT INTO personx(usercode, username, address, birthday, height, weight, remark) 
VALUES ('P009', 'YYYY', '台中', '1999-9-9', 199, 99, 'OK')
";

// 執行SQL
mysqli_query($link, $sqlstr);

// 關閉資料庫
// mysqli_close($link);

echo 'OK';
?>